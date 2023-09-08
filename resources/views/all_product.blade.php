<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Products</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>₦{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ optional($product->category)->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Edit" class="mx-3">
                                            <i class="fa fa-pencil color-muted"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Close">
                                            <i class="fa fa-close color-danger"></i>
                                        </a>
                                    </td>



                                </tr>
                                @endforeach

                                <!-- Display pagination links -->
                                {{ $products->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
