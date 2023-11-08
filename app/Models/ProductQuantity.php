<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductQuantity extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'quantity', 'company_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
