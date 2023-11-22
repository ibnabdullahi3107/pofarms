<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'amount', 'description', 'company_id', 'bank_id'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
