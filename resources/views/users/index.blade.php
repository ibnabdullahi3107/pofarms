<!-- resources/views/users/index.blade.php -->
<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users</h4>
                    <div class="basic-form">
                        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

                        @if($users->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <!-- Add delete button if needed -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No users available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
