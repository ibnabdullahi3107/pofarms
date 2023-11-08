<x-app-layout>

    <div class="content-body ">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-widget mt-5">
                    <div class="card-body gradient-4">
                        <h3 class="text-white text-center">Create Product</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" name="unit" id="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" value="{{ old('unit') }}" required>
                                @if ($errors->has('unit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="cost_price">Cost Price</label>
                                <input type="number" name="cost_price" id="cost_price" class="form-control{{ $errors->has('cost_price') ? ' is-invalid' : '' }}" value="{{ old('cost_price') }}" required>
                                @if ($errors->has('cost_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cost_price') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="selling_price">Selling Price</label>
                                <input type="number" name="selling_price" id="selling_price" class="form-control{{ $errors->has('selling_price') ? ' is-invalid' : '' }}" value="{{ old('selling_price') }}" required>
                                @if ($errors->has('selling_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('selling_price') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
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
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select a Category</option>
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Product</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
$('#company_id').on('change', function () {
    var companyId = $(this).val();
    // Send an AJAX request to fetch the categories for the selected company
    $.ajax({
        url: '/get-categories/' + companyId, // Use the correct route
        method: 'GET',
        success: function (response) {
            // Clear and populate the category dropdown with the fetched categories
            $('#category_id').empty();
            $('#category_id').append($('<option value="">Select a Category</option>'));
            $.each(response.categories, function (index, category) {
                $('#category_id').append($('<option value="' + category.id + '">' + category.name + '</option>'));
            });
        }
    });
});
</script>
