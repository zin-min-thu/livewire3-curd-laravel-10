<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Clicker extends Component
{
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
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
    }

    public function render()
    {
        return view('livewire.clicker', [
            'title' => 'User Component',
            'users' => User::all(),
        ]);
    }
}
