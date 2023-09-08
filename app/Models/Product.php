<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'description',
        'quantity',
        'product_category_id',
        'price',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category_id');
    }

}
