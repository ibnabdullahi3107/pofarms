<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['company', 'product', 'client'])->get();
        return view('sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = Sale::with(['company', 'product', 'client'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function create()
    {
        $companies = Company::all();
        $products = Product::all();
        $clients = Client::all();
        return view('sales.create', compact('companies', 'products', 'clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'quantity_sold' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Fetch the product based on the product_id
        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error_message', 'Product not found.');
        }


        // Calculate the amount based on the product price and quantity_sold
        $amount = $product->selling_price * $request->quantity_sold;

        // Generate a unique cart ID
        $cartId = $this->generateCartId();

        // Deduct quantity from product_quantities table
        $this->deductProductQuantity($request->product_id, $request->quantity_sold, $request->company_id);

        // Determine status based on the amount paid
        $status = ($request->paid_amount >= $amount) ? 'paid' : 'pending';

        // Create the sale record
        Sale::create([
            'u_price' => $product->selling_price, // Store the unit price (normal amount of the product)
            'quantity_sold' => $request->quantity_sold,
            'amount' => $amount,
            'paid_amount' => $request->paid_amount,
            'cart_id' => $cartId,
            'description' => $request->description,
            'client_id' => $request->client_id,
            'product_id' => $request->product_id,
            'company_id' => $request->company_id,
            'status' => $status,
        ]);

        return redirect()->route('sales.index')->with('success_message', 'Sale created successfully.');
    }


    private function generateCartId()
    {
        return uniqid('cart_', true);
    }

    private function deductProductQuantity($productId, $quantitySold, $companyId)
    {
        $productQuantity = ProductQuantity::where('product_id', $productId)
            ->where('company_id', $companyId)
            ->first();

        if ($productQuantity) {
            if ($productQuantity->quantity >= $quantitySold) {
                $productQuantity->quantity -= $quantitySold;
                $productQuantity->save();
            } else {
                // If quantity is insufficient, you can handle it as per your requirement
                // For example, redirect back with an error message
                return redirect()->back()->with('error_message', 'Insufficient quantity available.');
            }
        } else {
            // If the product quantity record does not exist, you can handle it as per your requirement
            // For example, redirect back with an error message
            return redirect()->back()->with('error_message', 'Product quantity record not found.');
        }
    }


    private function getStatus($paidAmount, $totalAmount)
    {
        return $paidAmount >= $totalAmount ? 'paid' : 'pending';
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $companies = Company::all();
        $products = Product::all();
        $clients = Client::all();

        return view('sales.edit', compact('sale', 'companies', 'products', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'quantity_sold' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update($request->all());

        return redirect()->route('sales.index')->with('success_message', 'Sale updated successfully.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('sales.index')->with('success_message', 'Sale deleted successfully.');
    }

    public function getProductsByCompany($id)
    {
        $products = Product::where('company_id', $id)->get(['id', 'name']);

        return response()->json(['products' => $products]);
    }

    public function getClientsByCompany($id)
    {
        $clients = Client::where('company_id', $id)->get(['id', 'name']);

        return response()->json(['clients' => $clients]);
    }
}
