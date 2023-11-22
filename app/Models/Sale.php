<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'u_price',
        'quantity_sold',
        'amount',
        'paid_amount',
        'cart_id',
        'description',
        'client_id',
        'product_id',
        'company_id',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
