<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Beneficiary</h4>
                    <div class="basic-form">
                        <form action="#">
                            <div class="input-group mb-3">
                                {{-- <div class="input-group-prepend"><span class="input-group-text">@</span>
                                </div> --}}
                                <input type="text" name="name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
                                {{-- <div class="input-group-append"><span class="input-group-text">@example.com</span>
                                </div> --}}
                            </div>
                            <div class="input-group mb-3">
                                {{-- <div class="input-group-prepend"><span class="input-group-text">Quantity</span>
                                </div> --}}
                                <input type="number" name="quantity" class="form-control" placeholder="Ward">
                            </div>
                            <div class="input-group mb-3">
                                {{-- <div class="input-group-prepend"><span class="input-group-text">Quantity</span>
                                </div> --}}
                                <input type="number" name="poll" class="form-control" placeholder="Polling Unit">
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Address</span>
                                </div>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
</x-app-layout>
