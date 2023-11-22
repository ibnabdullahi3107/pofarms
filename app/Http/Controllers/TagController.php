<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Company;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('company')->get();

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        $companies = Company::all();

        return view('tags.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        Tag::create($request->all());

        return redirect()->route('tags.index')->with('success_message', 'Tag created successfully.');
    }

    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        $companies = Company::all();

        return view('tags.edit', compact('tag', 'companies'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags,name,' . $tag->id,
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')->with('success_message', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->with('success_message', 'Tag deleted successfully.');
    }

 

}
