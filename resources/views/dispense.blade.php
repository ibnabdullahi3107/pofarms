<x-app-layout>
    <div class="content-body text-center">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-widget">
                    <div class="card-body gradient-4">
                        <h3 class="text-white">DISPENSE</h3>
                    </div>
                </div>
                <form method="POST" action="{{ route('dispense.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" name="beneficiary_id" class="tdl-new2 form-control" placeholder="Enter Beneficiary ID" autofocus required value="{{ old('beneficiary_id') }}">
                            </div>
                            @error('beneficiary_id')
                                <div class="alert alert-danger">
                                    <strong class="text-bold text-left">Beneficiary Id not exist</strong>
                                </div>
                            @enderror

                            <div class="input-group mb-3">
                                <select name="product_id" class="form-control">
                                    <option value="">-- Select Product --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <input type="number" name="quantity" class="tdl-new2 form-control" placeholder="Enter Quantity" required value="{{ old('quantity') }}">
                            </div>

                            <div class="input-group mb-3">
                                <textarea name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Dispense</button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>

        <div class="container my-4">
            <div class="progress" style="height: 9px">
                <div class="progress-bar bg-primary wow  progress-" style="width: 100%;" role="progressbar"><span class="sr-only">60% Complete</span>
                </div>
            </div>
        </div>

                <!-- Check if there are dispense records -->
                @if($dispenses->isNotEmpty())

                <div class="row justify-content-center">

                    <div class="col-10">
                        <div class="card border-primary">
                            <div class="card-header py-3">
                                @foreach ($user as $person)
                                <h4>{{ $person->name }}</h4>
                                <strong>{{ $person->client_id }}</strong>
                                <h5>{{ $person->address }}</h5>
                                <h5>{{ $person->phone_number }}</h5>
                                @endforeach
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Dispense Card Table</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered verticle-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">Client Id</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dispenses as $dispense)
                                                <tr>
                                                    <td>{{ $dispense->client_id }}</td>
                                                    <td>{{ $dispense->product->name }}</td>
                                                    <td>{{ $dispense->product->price }}</td>
                                                    <td>{{ $dispense->quantity }}</td>
                                                    <td></td> <!-- Assuming you have a method to calculate the amount -->
                                                    <td>
                                                        <!-- Your action buttons here -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div class="card-footer"><h2>Total Amount : <strong class="text-dark">{{ $dispense->calculateAmount() }}</strong></strong></h2>
                            </div>
                        </div>
                    </div>

                </div>

                @endif



    </div>
</x-app-layout>
