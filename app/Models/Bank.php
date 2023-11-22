<?php

namespace App\Models;

use App\Models\Company;
use App\Models\BankTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['account_name', 'bank_name', 'amount', 'company_id'];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function bankTransactions()
    {
        return $this->hasMany(BankTransaction::class);
    }
}
