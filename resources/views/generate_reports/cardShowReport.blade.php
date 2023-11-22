<x-app-layout>
    <div class="content-body">
        <div class="row justify-content-center mt-5 p-3">
            <div class="col-lg-12">
                <div class="card p-3">
                    <div class="card-header">
                        <h4 class="card-title bg-dark text-center p-3" style="border-radius: 50px">Generated Report</h4>
                    </div>
                    <hr/>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="color: blue; font-weight: bold;">
                                <thead class="bg-dark" style="color: white; font-weight: bold;">
                                    <tr>
                                        <th>Company</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Tag ID</th>
                                        <th>Date</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($disasters as $disaster)
                                    <tr>
                                        <td>{{ $disaster->company->name }}</td>
                                        <td>{{ $disaster->product->name }}</td>
                                        <td>{{ $disaster->total_quantity }}</td>
                                        <td>{{ $disaster->tag->name }}</td>
                                        <td>{{ $disaster->latest_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-end">
                            <form action="{{ route('generate.pdf.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="start_date" value="{{ $startDate }}">
                                <input type="hidden" name="end_date" value="{{ $endDate }}">
                                <button type="submit" class="btn btn-primary">Generate PDF</button>
                            </form>

                        </div>

                        @if(session('pdf_generated'))
                            <div class="alert alert-success mt-3" role="alert">
                                PDF generated successfully! <a href="{{ session('pdf_generated') }}" target="_blank" class="alert-link">Download PDF</a>.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
