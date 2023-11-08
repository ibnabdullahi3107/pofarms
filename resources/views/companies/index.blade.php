<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Companies</h4>
                        <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add Company</a>
                    </div>
                    
                    <div class="basic-form">
                        @if($companies->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td>{{ $company->id }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->email }}</td>
                                            <td>{{ $company->phone }}</td>
                                            <td>
                                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No companies available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
