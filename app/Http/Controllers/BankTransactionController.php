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
        $banks = Bank::all();
        return view('bank_transactions.create', compact('companies'));
    }

    public function store(Request $request)
    {
        // Validate and store the new bank transaction
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'description' => 'nullable',
            'company_id' => 'required',
            'bank_id' => 'required',
        ]);

        // Retrieve the bank record for the given company and bank
        $bank = Bank::where('company_id', $request->input('company_id'))
            ->where('id', $request->input('bank_id'))
            ->first();

        if (!$bank) {
            return redirect()->route('bank_transactions.index')
                ->with('error_message', 'Bank not found');
        }

        if ($request->input('type') == 'withdraw' && $bank->amount < $request->input('amount')) {
            return redirect()->route('bank_transactions.index')
                ->with('error_message', 'Insufficient funds for withdrawal');
        }

        // Update the bank amount based on the transaction type
        $bank->amount = ($request->input('type') == 'deposit')
            ? $bank->amount + $request->input('amount')
            : $bank->amount - $request->input('amount');

        $bank->save();

        // Create the bank transaction record
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

        // Retrieve the bank record for the given company and bank
        $bank = Bank::where('company_id', $request->input('company_id'))
            ->where('id', $request->input('bank_id'))
            ->first();

        if (!$bank) {
            return redirect()->route('bank_transactions.index')
                ->with('error_message', 'Bank not found');
        }

        if ($request->input('type') == 'withdraw' && $bank->amount < $request->input('amount')) {
            return redirect()->route('bank_transactions.index')
                ->with('error_message', 'Insufficient funds for withdrawal');
        }

        // Update the bank amount based on the transaction type
        $bank->amount = ($request->input('type') == 'deposit')
            ? $bank->amount + $request->input('amount')
            : $bank->amount - $request->input('amount');

        $bank->save();

        // Update the bank transaction record
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
