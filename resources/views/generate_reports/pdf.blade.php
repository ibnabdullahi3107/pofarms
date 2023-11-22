<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        #app {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .content-body {
            flex: 1;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .card-title {
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #343a40;
            color: #fff;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .bg-dark {
            background-color: #343a40 !important;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        @media (max-width: 575.98px) {
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }
        }

        </style>
    </head>

<body>
    <div id="app">
        <!-- Your navigation or header content -->
        <main>
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
                                    <table class="table table-bordered " style="color: blue; font-weight: bold;">
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Your footer or other content -->
    </div>
</body>

</html>

