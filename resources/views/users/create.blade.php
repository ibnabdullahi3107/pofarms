<!-- resources/views/users/create.blade.php -->
<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add User</h4>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf <!-- Add CSRF token field for security -->

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
