<x-app-layout>
    <div class="content-body">
        <div class="row d-flex justify-content-center mt-5 p-3">
                <div class="col-lg-6 col-sm-8">
                    <div class="row justify-content-center">
                    <a href="{{ route('bank.index') }}" class="btn btn-primary mb-3">All Bank Account</a>
                </div>
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h2 class="card text-primary text-center">{{ $bank->company->name }}</h2>
                            <h3 class="card-title text-white">Bank Account Information</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">Balance: ₦{{ $bank->amount }}</h2>
                                <p class="text-white mb-3">Account Name: {{ $bank->account_name }}</p>
                                <p class="text-white mb-3">Bank Name: {{ $bank->bank_name }}</p>
                                <p class="text-white mb-3">{{ now()->format('M d, Y') }}</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
</x-app-layout>




