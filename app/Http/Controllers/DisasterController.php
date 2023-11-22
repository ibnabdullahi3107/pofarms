<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Disaster;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisasterController extends Controller
{
    public function index()
    {
        $disasters = Disaster::with('product', 'company')->get();
        return view('disaster.index', compact('disasters'));
    }

    public function create()
    {
        $products = Product::all();
        $companies = Company::all();
        return view('disaster.create', compact('products', 'companies'));
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:0',
        'company_id' => 'required|exists:companies,id',
        'tag_id' => 'required|exists:tags,id',
    ]);

    try {
        // Start a database transaction
        DB::beginTransaction();

        // Deduct quantity from the product_quantities table
        $deductedSuccessfully = $this->deductProductQuantity($request->product_id, $request->quantity, $request->company_id);

        if (!$deductedSuccessfully) {
            // If deduction fails, throw an exception to roll back the transaction
            throw new \Exception('Failed to deduct quantity. Insufficient quantity in the store or no quantity records found for the selected company.');
        }

        // Create the disaster record
        $disaster = Disaster::create($request->all());

        // Commit the transaction
        DB::commit();

        return redirect()->route('disaster.index')->with('success_message', 'Disaster created successfully.');
    } catch (\Exception $e) {
        // An error occurred, so roll back the transaction
        DB::rollBack();

        return redirect()->back()->with('error_message', $e->getMessage());
    }
}

public function update(Request $request, Disaster $disaster)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:0',
        'company_id' => 'required|exists:companies,id',
        'tag_id' => 'required|exists:tags,id',
    ]);

    try {
        // Start a database transaction
        DB::beginTransaction();

        // Deduct quantity from the product_quantities table
        $deductedSuccessfully = $this->deductProductQuantity($request->product_id, $request->quantity, $request->company_id);

        if (!$deductedSuccessfully) {
            // If deduction fails, throw an exception to roll back the transaction
            throw new \Exception('Failed to deduct quantity. Insufficient quantity in the store or no quantity records found for the selected company.');
        }

        // Update the disaster record
        $disaster->update($request->all());

        // Commit the transaction
        DB::commit();

        return redirect()->route('disaster.index')->with('success_message', 'Disaster updated successfully.');
    } catch (\Exception $e) {
        // An error occurred, so roll back the transaction
        DB::rollBack();

        return redirect()->back()->with('error_message', $e->getMessage());
    }
}
    // Method to deduct quantity from the product_quantities table
    private function deductProductQuantity($productId, $quantity, $companyId)
    {
        $productQuantity = ProductQuantity::where('product_id', $productId)
            ->where('company_id', $companyId)
            ->first();

        if ($productQuantity) {
            if ($productQuantity->quantity >= $quantity) {
                $productQuantity->quantity -= $quantity;
                $productQuantity->save();
                return true; // Quantity deduction successful
            } else {
                // If the requested quantity is not available, show an error message
                return false; // Quantity deduction failed
            }
        } else {
            // Handle the case where no product quantity record is found
            return false; // Quantity deduction failed
        }
    }

    public function destroy(Disaster $disaster)
    {
        $disaster->delete();

        return redirect()->route('disaster.index')->with('success_message', 'Disaster deleted successfully.');
    }

    public function getProductsByCompany($companyId)
    {
        // Fetch the products for the selected company
        $products = Product::where('company_id', $companyId)->get();

        return response()->json(['products' => $products]);
    }

    public function getTagsByCompany($companyId)
    {
        // Fetch tags/descriptions based on the company ID
        $tags = Tag::where('company_id', $companyId)->get();

        return response()->json(['tags' => $tags]);
    }

}
