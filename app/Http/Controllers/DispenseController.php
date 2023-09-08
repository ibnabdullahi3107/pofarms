<?php

namespace App\Http\Controllers;

use App\Models\Dispense;
use App\Http\Requests\StoreDispenseRequest;
use App\Http\Requests\UpdateDispenseRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DispenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        $dispenses = Dispense::where('client_id', auth()->user()->client_id)->get();
        $user = User::where('client_id', auth()->user()->client_id)->get();

        return view('dispense', compact('products', 'dispenses', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'beneficiary_id' => 'required|exists_in_users', // Use the custom rule here
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
        ]);

        // Retrieve the selected product
        $product = Product::find($request->input('product_id'));

        // Check if the product exists
        if (!$product) {
            return redirect()->route('add_dispense')->with('error_message', 'Selected product not found');
        }

        // Check if the requested quantity is available
        if ($request->input('quantity') > $product->quantity) {
            return redirect()->route('add_dispense')->with('error_message', 'Insufficient quantity for the selected product');
        } else {
            // Reduce the product quantity by the requested amount
            $product->quantity -= $request->input('quantity');
            $product->save();

                    // Retrieve the user based on client_id
        $user = DB::table('users')
            ->where('client_id', $request->input('beneficiary_id'))
            ->first();

        if (!$user) {
            return redirect()->route('add_dispense')->with('error_message', 'Beneficiary not found');
        }

        // Create a new dispense record
        Dispense::create([
            'client_id' => $user->client_id,
            'product_id' => $product->id,
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('add_dispense')->with('success_message', 'Dispense record created successfully');


        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Dispense $dispense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dispense $dispense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDispenseRequest $request, Dispense $dispense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dispense $dispense)
    {
        //
    }
}
