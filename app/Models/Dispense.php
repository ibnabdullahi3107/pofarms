<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dispense extends Model
{
    use HasFactory;

    protected $fillable = [

        'client_id',
        'product_id',
        'quantity',
        'description'
    ];
      // Define a method to calculate the amount
  // Define a method to calculate the amount
  public function calculateAmount()
  {
      // Assuming you have a 'product' relationship defined
      // You can adjust this calculation logic based on your requirements

      // Get all previous dispenses for the same client and product
      $previousDispenses = $this->where('client_id', $this->client_id)
          ->where('product_id', $this->product_id)
          ->where('created_at', '<', $this->created_at)
          ->get();

      // Calculate the sum of amounts for previous dispenses
      $previousTotal = $previousDispenses->sum(function ($dispense) {
          return $dispense->quantity * $dispense->product->price;
      });

      // Calculate the amount for the current dispense
      $currentAmount = $this->quantity * $this->product->price;

      // Calculate the total amount including previous dispenses
      return $previousTotal + $currentAmount;
  }
        // Define a relationship with the Product model
        public function product()
        {
            return $this->belongsTo(Product::class, 'product_id');
        }
}
