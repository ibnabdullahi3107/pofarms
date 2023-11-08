<!-- resources/views/clients/create.blade.php -->

<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Client</h4>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('clients.store') }}">
                            @csrf <!-- Add CSRF token field for security -->

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
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
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <select name="company_id" id="company_id" class="form-control" required>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save Client</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
