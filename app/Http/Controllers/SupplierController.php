<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Supplier;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('suppliers.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:suppliers,email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('suppliers.index')->with('success_message', 'Supplier created successfully');
    }

    public function edit(Supplier $supplier)
    {
        $companies = Company::all();
        return view('suppliers.edit', compact('supplier', 'companies'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('suppliers.index')->with('success_message', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success_message', 'Supplier deleted successfully');
    }
}
