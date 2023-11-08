<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('categories.update', $category->id) }}">
                            @csrf <!-- Add CSRF token field for security -->
                            @method('PUT') <!-- Add method spoofing for update -->

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $category->name) }}" required>
                            </div>
                                                        @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <label for="company_id">Select Company:</label>
                                <select name="company_id" id="company_id" class="form-control" required>
                                    <option value="">-- Select Company --</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $category->company_id) == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            @error('company_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
