<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_id',
    ];

    
public function products()
{
    return $this->hasMany(Product::class);
}

public function company()
{
    return $this->belongsTo(Company::class);
}

}
