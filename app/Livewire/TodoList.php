<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|string|min:3|max:50')]
    public $name;

    public $search;

    public $editId;

    #[Rule('required|string|min:3|max:50')]
    public $editName;

    public function create()
    {
        $validated = $this->validateOnly('name');

        Todo::create($validated);

        $this->reset('name');

        session()->flash('message', 'Created.');

        $this->resetPage();
    }

    public function delete($id)
    {
        try {
            Todo::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed deleteion todo.');
        }
    }

    public function toggle(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);
    }

    public function edit(Todo $todo)
    {
        $this->editId = $todo->id;
        $this->editName = $todo->name;
    }

    public function cancelEdit()
    {
        $this->reset('editId', 'editName');
    }

    public function update()
    {
        $this->validateOnly('editName');
    
        Todo::find($this->editId)->update([
            'name' => $this->editName
        ]);

        $this->cancelEdit();
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::where('name', 'like',"%{$this->search}%")->latest('id')->paginate(5)
        ]);
    }
}
