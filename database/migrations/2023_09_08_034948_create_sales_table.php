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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('u_price', 12, 2); // Adjusted precision
            $table->integer('quantity_sold');
            $table->decimal('amount', 12, 2);
            $table->decimal('paid_amount', 12, 2);
            $table->string('cart_id')->nullable(); 
            $table->enum('status', ['pending', 'paid']);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('company_id');

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
