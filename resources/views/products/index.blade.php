<x-app-layout>
    <div class="content-body text-center">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-widget">
                    <div class="card-body gradient-4">
                        <h3 class="text-white">Product List</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if($products->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">P Name</th>
                                            <th scope="col">P Unit</th>
                                            <th scope="col">P Selling Price</th>
                                            <th scope="col">P Code</th>
                                            <th scope="col">P Category</th>
                                            <th scope="col">P Company</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> <!-- This will display the serial number -->
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>₦{{ $product->selling_price }}</td>                                                
                                                <td>{{ $product->product_code }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->company->name }}</td>
                                                <td>
                                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No products found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
