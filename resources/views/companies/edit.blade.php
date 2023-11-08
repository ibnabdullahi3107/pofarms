<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Company</h4>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('companies.update', $company->id) }}">
                            @csrf <!-- Add CSRF token field for security -->
                            @method('PUT') <!-- Add method spoofing for update -->

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}" required>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Description</span></div>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update Company</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
