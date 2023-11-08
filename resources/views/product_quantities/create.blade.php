<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-widget">
                    <div class="card-body gradient-4">
                        <h3 class="text-white text-center">Add Product Quantity</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('product_quantities.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control">
                                    <option value="">Select a Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="product-selection" style="display: none;">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <!-- Product options will be loaded here dynamically -->
                                </select>
                            </div>

                            <div class="form-group" id="quantity-input" style="display: none;">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" required value="{{ old('quantity') }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" id="add-quantity-button" style="display: none;">Add Quantity</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Listen for changes in the company select field
    $('#company_id').on('change', function () {
        const companyId = $(this).val();
        const productSelect = $('#product_id');

        if (companyId) {
            $.ajax({
                url: '/get-products-by-company/' + companyId,
                method: 'GET',
                success: function (response) {
                    productSelect.empty().append('<option value="">Select a Product</option>');

                    if (response.products.length > 0) {
                        response.products.forEach(function (product) {
                            productSelect.append($('<option>', {
                                value: product.id,
                                text: product.name
                            }));
                        });

                        // Show the product selection and quantity input fields
                        $('#product-selection').show();
                        $('#quantity-input').show();
                        $('#add-quantity-button').show();
                    } else {
                        productSelect.append('<option value="">No Products Available</option>');
                        $('#product-selection').show();
                        $('#quantity-input').hide();
                        $('#add-quantity-button').hide();
                    }
                },
                error: function (xhr, status, error) {
                    // Log errors to the console
                    console.log("XHR Status: " + status);
                    console.log("Error: " + error);
                    productSelect.empty().append('<option value="">Error Fetching Products</option>');
                    $('#product-selection').show();
                    $('#quantity-input').hide();
                    $('#add-quantity-button').hide();
                }
            });
        } else {
            // If no company is selected, hide the product selection and quantity input fields
            $('#product-selection').hide();
            $('#quantity-input').hide();
            $('#add-quantity-button').hide();
        }
    });
</script>



