<x-app-layout>
    <div class="content-body">
        <div class="row d-flex justify-content-center mt-5 p-3">
            <div class="col-lg-10">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Tags</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add New Tag</a>
                        @if($tags->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Tag Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Company</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tags as $tag)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tag->name }}</td>
                                                <td>{{ $tag->description ?? 'N/A' }}</td>
                                                <td>{{ $tag->company->name }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a style="margin-right: 5px;" href="{{ route('tags.show', $tag->id) }}" class="btn btn-info btn-sm">Show</a>
                                                        <a style="margin-right: 5px;" href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No tags found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
