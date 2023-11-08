<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductQuantity;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'description', 'cost_price', 'selling_price', 'product_code', 'category_id', 'company_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function productQuantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }

}
