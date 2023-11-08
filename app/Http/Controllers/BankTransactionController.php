<?php

namespace App\Http\Controllers;
use App\Models\Bank;
use App\Models\BankTransaction;
use App\Models\Company;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{public function index()
    {
        $bankTransactions = BankTransaction::all();
        return view('bank_transactions.index', compact('bankTransactions'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('bank_transactions.create', compact('companies'));
    }

    public function store(Request $request)
    {
        // Validate and store the new bank transaction
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'company_id' => 'required',
            'bank_id' => 'required',
        ]);


        BankTransaction::create($request->all());

        return redirect()->route('bank_transactions.index')
            ->with('success_message', 'Bank transaction created successfully');
    }

    public function edit($id)
    {
        $bankTransaction = BankTransaction::find($id);
        $companies = Company::all();
        $banks = Bank::where('company_id', $bankTransaction->company_id)->get();
        return view('bank_transactions.edit', compact('bankTransaction', 'companies', 'banks'));
    }

    public function update(Request $request, $id)
    {
        $bankTransaction = BankTransaction::find($id);

        // Validate and update the bank transaction
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'company_id' => 'required',
            'bank_id' => 'required',
        ]);

        $bankTransaction->update($request->all());

        return redirect()->route('bank_transactions.index')
            ->with('success_message', 'Bank transaction updated successfully');
    }

    public function destroy($id)
    {
        $bankTransaction = BankTransaction::find($id);
        $bankTransaction->delete();

        return redirect()->route('bank_transactions.index')
            ->with('success_message', 'Bank transaction deleted successfully');
    }

    public function getBanksByCompany($company)
    {
        $banks = Bank::where('company_id', $company)->get();
        return response()->json(['banks' => $banks]);
    }

}
