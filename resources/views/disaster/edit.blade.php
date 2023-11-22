<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center mt-5 p-3">
            <div class="col-lg-8">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Edit Disaster</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('disaster.update', $disaster->id) }}">
                            @csrf <!-- CSRF Token for security -->
                            @method('PUT') <!-- Use PUT method for updating -->

                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id', $disaster->product_id) == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ old('quantity', $disaster->quantity) }}" required>
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" required>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $disaster->company_id) == $company->id ? 'selected' : '' }}>
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
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{ old('description', $disaster->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update Disaster</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 <!-- Your JavaScript code -->
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
</x-app-layout>
