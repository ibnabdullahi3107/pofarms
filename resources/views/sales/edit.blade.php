<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center mt-5 p-3">
            <div class="col-lg-8">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Edit Sale</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sales.update', $sale->id) }}">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updating -->

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $sale->company_id) == $company->id ? 'selected' : '' }}>
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
                                <label for="product_id">Product</label>
                                <select name="product_id" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Product</option>
                                </select>
                                @if ($errors->has('product_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="client_id">Client</label>
                                <select name="client_id" class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Client</option>
                                </select>
                                @if ($errors->has('client_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="quantity_sold">Quantity Sold</label>
                                <input type="number" name="quantity_sold" class="form-control{{ $errors->has('quantity_sold') ? ' is-invalid' : '' }}" value="{{ old('quantity_sold', $sale->quantity_sold) }}" required>
                                @if ($errors->has('quantity_sold'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity_sold') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="paid_amount">Paid Amount</label>
                                <input type="text" name="paid_amount" class="form-control{{ $errors->has('paid_amount') ? ' is-invalid' : '' }}" value="{{ old('paid_amount', $sale->paid_amount) }}" required>
                                @if ($errors->has('paid_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('paid_amount') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{ old('description', $sale->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update Sale</button>
                            </div>
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
        const clientSelect = $('#client_id');

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
                    } else {
                        productSelect.append('<option value="">No Products Available</option>');
                    }
                },
                error: function () {
                    productSelect.empty().append('<option value="">Error Fetching Products</option>');
                }
            });

            // Fetch clients based on the selected company
            $.ajax({
                url: '/get-clients-by-company/' + companyId,
                method: 'GET',
                success: function (response) {
                    clientSelect.empty().append('<option value="">Select a Client</option>');

                    if (response.clients.length > 0) {
                        response.clients.forEach(function (client) {
                            clientSelect.append($('<option>', {
                                value: client.id,
                                text: client.name
                            }));
                        });
                    } else {
                        clientSelect.append('<option value="">No Clients Available</option>');
                    }
                },
                error: function () {
                    clientSelect.empty().append('<option value="">Error Fetching Clients</option>');
                }
            });
        } else {
            // If no company is selected, reset the product and client selects
            productSelect.empty().append('<option value="">Select a Product</option>');
            clientSelect.empty().append('<option value="">Select a Client</option>');
        }
    });
</script>
