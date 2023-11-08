<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $companies = Company::all();
        return view('clients.create', compact('companies'));
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'company_id' => 'required|exists:companies,id',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success_message', 'Client created successfully.');
    }

    /**
     * Display the specified client.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\View\View
     */
    public function edit(Client $client)
    {
        $companies = Company::all();
        return view('clients.edit', compact('client', 'companies'));
    }

    /**
     * Update the specified client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'company_id' => 'required|exists:companies,id',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success_message', 'Client updated successfully.');
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success_message', 'Client deleted successfully.');
    }
}
