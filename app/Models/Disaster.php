<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'company_id', 'tag_id'];
    protected $casts = [
        'created_at' => 'datetime',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }



}
