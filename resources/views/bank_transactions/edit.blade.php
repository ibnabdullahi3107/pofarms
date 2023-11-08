<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center mt-5 p-3">
            <div class="col-lg-8">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Edit Bank Transaction</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bank_transactions.update', $bankTransaction->id) }}">
                            @csrf
                            @method('PUT') <!-- Use the PUT method for updates -->

                            <div class="form-group">
                                <label for="type">Transaction Type</label>
                                <select name="type" id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                    <option value="withdraw" {{ old('type', $bankTransaction->type) == 'withdraw' ? 'selected' : '' }}>Withdraw</option>
                                    <option value="deposit" {{ old('type', $bankTransaction->type) == 'deposit' ? 'selected' : '' }}>Deposit</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount', $bankTransaction->amount) }}" required>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', $bankTransaction->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $bankTransaction->company_id) == $company->id ? 'selected' : '' }}>
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

                            <div class="form-group">
                                <label for="bank_id">Bank</label>
                                <select name="bank_id" id="bank_id" class="form-control{{ $errors->has('bank_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Bank</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}" {{ old('bank_id', $bankTransaction->bank_id) == $bank->id ? 'selected' : '' }}>
                                            {{ $bank->account_name }} ({{ $bank->bank_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bank_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update Bank Transaction</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        // Fetch the initial bank options based on the current company
        fetchBanksForCompany();

        // Attach an event listener to the company dropdown
        $('#company_id').on('change', function () {
            fetchBanksForCompany();
        });

        // Function to fetch banks based on the selected company
        function fetchBanksForCompany() {
            var companyId = $('#company_id').val();
            if (companyId) {
                $.ajax({
                    url: '/get-banks-by-company/' + companyId, // Replace with the correct route
                    method: 'GET',
                    success: function (response) {
                        // Clear and populate the bank dropdown with the fetched banks
                        $('#bank_id').empty();
                        $('#bank_id').append($('<option value="">Select a Bank</option>'));

                        $.each(response.banks, function (index, bank) {
                            $('#bank_id').append($('<option value="' + bank.id + '">' + bank.account_name + ' (' + bank.bank_name + ')</option>'));
                        });
                        // Set the selected bank (if it exists in the response)
                        $('#bank_id').val('{{ old('bank_id', $bankTransaction->bank_id) }}');
                    },
                    error: function (error) {
                        console.error('Error fetching banks:', error);
                    }
                });
            }
        }
    });
</script>