<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf <!-- Add CSRF token field for security -->

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="number" name="price" class="form-control" placeholder="Price" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                            </div>

                            <div class="input-group mb-3">
                                <select name="category" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Description</span></div>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

