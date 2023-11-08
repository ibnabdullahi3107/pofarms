<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function getCategoriesByCompany($companyId)
    {
        $categories = Category::where('company_id', $companyId)->get();

        return response()->json(['categories' => $categories]);
    }


    public function create()
    {
        $categories = Category::all();
        $companies = Company::all();

        return view('products.create', compact('categories', 'companies'));
    }

    public function store(Request $request)
    {
        // Validate and store a new product in the database.
        $request->validate([
            'name' => 'required|unique:products',
            'unit' => 'required',
            'description' => 'nullable',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        // Auto-generate the product code
        $productCode = 'PROD_' . uniqid();

        // Create the product with the generated code
        Product::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'description' => $request->description,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'product_code' => $productCode,
            'category_id' => $request->category_id,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('products.index')->with('success_message', 'Product created successfully.');
    }


    public function show(Product $product)
    {
        // Display a specific product.
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Return a view to edit a specific product.
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate and update a specific product in the database.
        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'unit' => 'required',
            'description' => 'nullable',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'product_code' => 'required|unique:products,product_code,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success_message', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete a specific product from the database.
        $product->delete();

        return redirect()->route('products.index')->with('success_message', 'Product deleted successfully.');
    }
}
