<?php

namespace App\Http\Controllers;

use App\Models\BankTransaction;
use App\Http\Requests\StoreBankTransactionRequest;
use App\Http\Requests\UpdateBankTransactionRequest;

class BankTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankTransactionRequest $request, BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BankTransaction $bankTransaction)
    {
        //
    }
}
