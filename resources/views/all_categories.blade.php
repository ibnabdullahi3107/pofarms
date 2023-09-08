<x-app-layout>
    <div class="content-body text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8 p-4">
                <div class="card">
                    <div class="card-header mt-3">
                        <h4 class="card-title">All Categories</h4>
                        <a href="{{ route('add_categories') }}" class="btn btn-success float-right">Create</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold text-primary">Name</th>
                                        <th class="font-weight-bold text-success">Created At</th>
                                        <th class="font-weight-bold text-success">Updated At</th>
                                        <th class="font-weight-bold text-danger">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <!-- Add action buttons here, e.g., edit and delete -->
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
