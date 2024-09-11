<x-app-layout>
    <div class="py-5 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full ">
                        <div class="container">
                            <h1>User Details</h1>
                            <div class="card">
                                <div class="card-header">
                                    User #{{ $user->id }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>