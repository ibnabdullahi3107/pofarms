<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Disaster;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{

    public function index()
    {
        // return view('generate_reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('generate_reports.create');
    }

    public function getDisastersByDateRange($startDate, $endDate)
    {
        // Use Carbon to parse the dates
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

     // Query the Disasters table based on the date range
        $disasters = Disaster::select(
            'company_id',
            'product_id',
            'tag_id',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('MAX(created_at) as latest_date')
        )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('company_id', 'product_id', 'tag_id')
        ->get();




        return $disasters;
    }

    public function processDateRange(Request $request)
    {
        // Validate the form data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Retrieve the start and end dates from the form
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query the Disasters table based on the date range
        $disasters = $this->getDisastersByDateRange($startDate, $endDate);

        // You can return the $disasters data as JSON
        return view('generate_reports.cardShowReport', compact('disasters', 'startDate', 'endDate'));
    }


public function generatePDF(Request $request)
{
    // Retrieve the start and end dates from the form
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Query the Disasters table based on the date range
    $disasters = $this->getDisastersByDateRange($startDate, $endDate);

    // dd($disasters, $startDate, $endDate);


    // Load the view with the data
    $pdf = PDF::loadView('generate_reports.pdf', compact('disasters', 'startDate', 'endDate'));

    // Save the PDF file
    $pdfPath = storage_path('app/generated_report.pdf');
    $pdf->save($pdfPath);

    // Download the PDF file
    return response()->download($pdfPath)->deleteFileAfterSend(true);
}



    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Retrieve the start and end dates from the form
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

         // Query the Disasters table based on the date range
        $disasters = $this->getDisastersByDateRange($startDate, $endDate);



        // Redirect back with a success message
        return redirect()->back()->with('success_message', 'Date range processed successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
