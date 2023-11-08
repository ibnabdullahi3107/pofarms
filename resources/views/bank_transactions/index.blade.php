<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center mt-5 p-3">
            <div class="col-lg-8">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Bank Transactions</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('bank_transactions.create') }}" class="btn btn-primary mb-3">Add New Bank Transaction</a>
                        @if ($bankTransactions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Account Name</th>
                                            <th scope="col">Bank Name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bankTransactions as $bankTransaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bankTransaction->company->name }}</td>
                                                <td>{{ $bankTransaction->bank->account_name }}</td>
                                                <td>{{ $bankTransaction->bank->bank_name }}</td>
                                                <td>{{ $bankTransaction->amount }}</td>
                                                <td>{{ $bankTransaction->type }}</td>
                                                <td>
                                                    <a href="{{ route('bank_transactions.edit', $bankTransaction->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No bank transactions found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
