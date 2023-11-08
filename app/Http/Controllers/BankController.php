<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Company;
use Illuminate\Http\Request;


class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();

        return view('bank.index', compact('banks'));
    }

    public function create()
    {
        $companies = Company::all();

        return view('bank.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_name' => 'required|string|max:255',
            'company_id' => ['required', 'exists:companies,id'],
            'bank_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        Bank::create([
            'account_name' => $request->input('account_name'),
            'bank_name' => $request->input('bank_name'),
            'amount' => $request->input('amount'),
            'company_id' => $request->input('company_id'),
        ]);

        return redirect()->route('bank.index')
            ->with('success_message', 'Bank account created successfully');
    }

    public function show($id)
    {
        $bank = Bank::find($id);

        return view('bank.show', compact('bank'));
    }

    public function edit($id)
    {
        $bank = Bank::find($id);
        $companies = Company::all();

        return view('bank.edit', compact('bank', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'account_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        $bank = Bank::find($id);
        $bank->update([
            'account_name' => $request->input('account_name'),
            'bank_name' => $request->input('bank_name'),
            'amount' => $request->input('amount'),
        ]);

        return redirect()->route('bank.index')
            ->with('success_message', 'Bank account updated successfully');
    }

    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();

        return redirect()->route('bank.index')
            ->with('success_message', 'Bank account deleted successfully');
    }
}
