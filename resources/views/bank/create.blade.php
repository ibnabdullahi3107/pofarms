<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center mt-5 p-3">
            <div class="col-lg-8">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Add New Bank</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bank.store') }}">
                            @csrf <!-- Add CSRF token field for security -->

                            <div class="form-group">
                                <label for="account_name">Account Name</label>
                                <input type="text" name="account_name" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" value="{{ old('account_name') }}" required>
                                @if ($errors->has('account_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" value="{{ old('bank_name') }}" required>
                                @if ($errors->has('bank_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount') }}" required>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>

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

                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Add Bank</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
