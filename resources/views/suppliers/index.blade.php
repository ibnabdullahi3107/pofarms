<!-- resources/views/suppliers/index.blade.php -->

<x-app-layout>
    <div class="content-body">
        <div class="row d-flex justify-content-center mt-5 p-3">
            <div class="col-lg-10">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">ALL SUPPLIERS</h4>
                        <a href="{{ route('suppliers.create') }}" class="btn btn-primary justify-content-end">Add Supplier</a>
                    </div>
                    <div class="card-body">
                        @if($suppliers->isEmpty())
                            <p>No suppliers available.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Company</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($suppliers as $supplier)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $supplier->company->name }}</td>
                                                <td>{{ $supplier->name }}</td>
                                                <td>{{ $supplier->email }}</td>
                                                <td>{{ $supplier->phone_number }}</td>
                                                <td>{{ $supplier->address }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a style="margin-right: 5px;" href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm mx-2">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
