<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $companies = Company::all();

        return view('categories.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => ['required', 'exists:companies,id'],
        ]);

        Category::create([
            'name' => $request->name,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('categories.index')->with('success_message', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category): View
    {
        $companies = Company::all();

        return view('categories.edit', compact('category', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => ['required', 'exists:companies,id'],
        ]);

        $category->update([
            'name' => $request->name,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('categories.index')->with('success_message', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success_message', 'Category deleted successfully.');
    }
}
