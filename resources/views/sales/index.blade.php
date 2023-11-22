<x-app-layout>
    <div class="content-body">
        <div class="row d-flex justify-content-center mt-5 p-3">
            <div class="col-lg-10">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Sales Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="sale_product">
                            <table class="table table-bordered table-sm table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">QTY Sold</th>
                                        <th scope="col">Paid Amount</th>
                                        <th scope="col">T_Amount</th>
                                        <th scope="col">R_Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sale->company->name }}</td>
                                            <td>{{ $sale->product->name }}</td>
                                            <td>{{ $sale->client->name }}</td>
                                            <td>{{ $sale->quantity_sold }}</td>
                                            <td>₦{{ $sale->paid_amount }}</td>
                                            <td>₦{{ $sale->amount }}</td>
                                            <td> ₦{{ $sale->amount - $sale->paid_amount }}</td>
                                            <td>{{ $sale->status }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    {{-- <a style="margin-right: 5px;" href="{{ route('sales.edit', $sale->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                                                    {{-- <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sale?')">Delete</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($sales->isEmpty())
                            <p class="text-center">No sales found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
