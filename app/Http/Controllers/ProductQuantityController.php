<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductQuantity;
use Illuminate\Http\Request;

class ProductQuantityController extends Controller
{
    public function index()
    {
        $productQuantities = ProductQuantity::with('product', 'company')->get();
        return view('product_quantities.index', compact('productQuantities'));
    }


    public function getProductsByCompany($companyId)
    {
        // Fetch the products for the selected company
        $products = Product::where('company_id', $companyId)->get();

        return response()->json(['products' => $products]);
    }

    public function create()
    {
        $products = Product::all();
        $companies = Company::all();

        return view('product_quantities.create', compact('products', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'company_id' => 'required|exists:companies,id',
        ]);

        // Check if a product quantity already exists for the selected product and company
        $existingProductQuantity = ProductQuantity::where('product_id', $request->product_id)
            ->where('company_id', $request->company_id)
            ->first();

        if ($existingProductQuantity) {
            // Add the new quantity to the existing product quantity
            $existingProductQuantity->quantity += $request->quantity;
            $existingProductQuantity->save();
        } else {
            // Create a new product quantity entry
            ProductQuantity::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'company_id' => $request->company_id,
            ]);
        }

        return redirect()->route('product_quantities.index')->with('success_message', 'Product quantity added successfully.');
    }


    public function edit(ProductQuantity $productQuantity)
    {
        $products = Product::all();
        $companies = Company::all();
        return view('product_quantities.edit', compact('productQuantity', 'products', 'companies'));
    }

    public function update(Request $request, ProductQuantity $productQuantity)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'company_id' => 'required|exists:companies,id',
        ]);

        $productQuantity->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('product_quantities.index')->with('success_message', 'Product quantity updated successfully.');
    }

    public function destroy(ProductQuantity $productQuantity)
    {
        $productQuantity->delete();
        return redirect()->route('product_quantities.index')->with('success_message', 'Product quantity deleted successfully.');
    }
}
