<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-widget mt-5">
                    <div class="card-body gradient-4">
                        <h3 class="text-white text-center">Product Quantities List</h3>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        @if($productQuantities->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Company</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productQuantities as $productQuantity)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $productQuantity->company->name }}</td>
                                                <td>{{ $productQuantity->product->category->name }}</td>
                                                <td>{{ $productQuantity->product->name }}</td>
                                                <td>{{ $productQuantity->quantity }}</td>
                                                <td>₦{{ $productQuantity->product->selling_price }}</td>

                                                <td>
                                                    <div class="btn-group">
                                                        <a style="margin-right: 5px;" href="{{ route('product_quantities.edit', $productQuantity->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('product_quantities.destroy', $productQuantity->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No product quantities found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
