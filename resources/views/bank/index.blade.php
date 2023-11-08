<x-app-layout>
    <div class="content-body">
        <div class="row d-flex justify-content-center mt-5 p-3">
            <div class="col-lg-10">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Bank Account Details</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('bank.create') }}" class="btn btn-primary mb-3">Add New Bank Account</a>
                        @if($banks->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Account Name</th>
                                            <th scope="col">Bank Name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($banks as $bank)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bank->company->name }}</td>
                                                <td>{{ $bank->account_name }}</td>
                                                <td>{{ $bank->bank_name }}</td>
                                                <td>₦{{ $bank->amount }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a style="margin-right: 5px;" href="{{ route('bank.show', $bank->id) }}" class="btn btn-info btn-sm">Show</a>
                                                        <a style="margin-right: 5px;" href="{{ route('bank.edit', $bank->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('bank.destroy', $bank->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this bank account?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No bank accounts found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
