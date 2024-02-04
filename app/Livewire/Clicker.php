<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;

    #[Rule('required|min:2|max:50')]
    public $name;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required|min:2')]
    public $password;

    public function createUser()
    {
        // $this->validate([
        //     'name' => 'required|min:2|max:10',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:5'
        // ]);
        $validated = $this->validate();
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $this->reset(['name', 'email', 'password']);
        session()->flash('message', 'User created successful.');
    }

    public function render()
    {
        return view('livewire.clicker', [
            'title' => 'User Component',
            'users' => User::paginate(5),
        ]);
    }
}
