<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{
    #[Rule('required|string|min:3|max:50')]
    public $name;

    public $search;

    public function create()
    {
        $validated = $this->validateOnly('name');

        Todo::create($validated);

        $this->reset('name');

        session()->flash('message', 'Created.');
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest('id')->get()
        ]);
    }
}
