<div class="container">
    @if (session('message'))
        <p class="px-3 py-3 bg-green-600 text-white rounded">{{ session('message') }}</p>
    @endif
    <form class="p-5" wire:submit="createUser">
        Name: <input class="block rounded border border-gray-80 px-3 py-1 mb-1" type="text" placeholder="name" wire:model="name">
        @error('name')
            <p class="text-red-500 text-xs">{{ $message }} </p>
        @enderror
        Email: <input class="block rounded border border-gray-80 px-3 py-1 mb-1" type="text" placeholder="email" wire:model="email">
        @error('email')
            <p class="text-red-500 text-xs">{{ $message }} </p>
        @enderror
        Password: <input class="block rounded border border-gray-80 px-3 py-1 mb-1" type="password" placeholder="password" wire:model="password">
        @error('password')
            <p class="text-red-500 text-xs">{{ $message }} </p>
        @enderror
        <button class="block rounded px-3 py-1 bg-gray-700 text-white" type="submit">Save</button>
    </form>
    <hr>
    <table class="table-fixed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
