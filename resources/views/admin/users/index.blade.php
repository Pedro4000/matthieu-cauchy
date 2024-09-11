<x-app-layout>
    <div class="py-5 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full ">
                        <div class="container">
                            <h3>Users</h1>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-dark mb-3">Create New User</a>
                            @if($users->isEmpty())
                                <p>No users found.</p>
                            @else
                                <table class="list-table">
                                    <thead>
                                        <tr>
                                            <th class="w-1/12 p-2">ID</th>
                                            <th class="w-1/12 p-2">Name</th>
                                            <th class="w-1/12 p-2">Email</th>
                                            <th class="w-1/12 p-2" >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info">View</a>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-warning">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info">View</a>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-warning">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info">View</a>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-warning">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info">View</a>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-warning">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>