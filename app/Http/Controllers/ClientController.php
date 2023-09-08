<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate the form data here
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|exists:categories,id', // Validate that the category exists in the database
            'description' => 'nullable|string',
        ]);

        // Create a new product using the validated data
        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'product_category_id' => $validatedData['category'],
            'description' => $validatedData['description'],
        ]);

        // Redirect to a success page or do something else
        return redirect()->route('add_product')->with('success_message', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
