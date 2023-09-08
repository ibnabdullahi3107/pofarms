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

            $table->decimal('u_price', 10, 1);
            $table->integer('quantity_sold');
            $table->decimal('amount',10,1);
            $table->decimal('paid',10,1);

            $table->string('description')->nullable();
            $table->string('phone_number')->nullable();
            $table->foriegnId('client_id')->references('id')->on('clients');
            $table->foriegnId('product_id')->references('id')->on('products');
            $table->foriegnId('company_id')->references('id')->on('companies');


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
