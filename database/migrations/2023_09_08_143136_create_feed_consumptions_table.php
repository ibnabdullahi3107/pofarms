<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feed_consumptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('company_id');
            $table->integer('quantity');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade'); 

            $table->timestamps();
        });

    }
    /**
     * Feed Balance
     * $feed_remain= sum(Purchased::all('quantity')->where('product_id','feed_c->product->id'))- sum(FeedConsumption::all('quantity'))
     */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feed_consumptions');
    }
};
