<?php

namespace App\Models;

use App\Models\User;
use App\Models\Bank;
use App\Models\Client;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'company_id');
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }    
    
    public function bank()
    {
        return $this->hasMany(Bank::class);
    }
    
}
