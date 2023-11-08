<!-- resources/views/suppliers/create.blade.php -->

<x-app-layout>
    <div class="content-body">
        <div class="row d-flex justify-content-center mt-5 p-3">
            <div class="col-lg-10">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">ADD NEW SUPPLIER</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('suppliers.store') }}">
                            @csrf <!-- Add CSRF token field for security -->


                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Supplier Name" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="text-danger mb-3">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="text-danger mb-3">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone" value="{{ old('phone_number') }}">
                            </div>
                            @error('phone_number')
                                <div class="text-danger mb-3">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <textarea name="address" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <div class="text-danger mb-3">{{ $message }}</div>
                            @enderror


                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Add Supplier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
