<x-app-layout>
    <div class="content-body text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 p-4">
                <div class="card">
                    <div class="card-header mt-2">
                        <h4 class="card-title">Add Categories</h4>
                        <a href="{{ route('all_categories') }}" class="btn btn-success float-right">View</a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('categories.store') }}">
                                @csrf <!-- Add CSRF token field for security -->

                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
    
                                <div class="input-group">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


