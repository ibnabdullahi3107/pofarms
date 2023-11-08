<!-- resources/views/clients/index.blade.php -->

<x-app-layout>
    <div class="content-body">
        <div class="col-lg-12 p-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Clients</h4>
                    <div class="basic-form">
                        <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Add Client</a>
                        @if($clients->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->phone_number }}</td>
                                            <td>{{ $client->address }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->company->name }}</td>
                                            <td>
                                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <!-- Add delete button if needed -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No clients available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
