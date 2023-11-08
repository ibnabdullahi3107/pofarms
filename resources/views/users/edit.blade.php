<!-- resources/views/users/edit.blade.php -->
<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf <!-- Add CSRF token field for security -->
                            @method('PUT') <!-- Add method spoofing for update -->

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Password</span></div>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Confirm Password</span></div>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
