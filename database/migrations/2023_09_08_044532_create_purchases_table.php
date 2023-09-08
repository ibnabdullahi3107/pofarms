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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foriegnId('company_id')->references('id')->on('companies');

            $table->foriegnId('product_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->decimal('u_price',10,1);
            $table->text('decription')->nullable();
            $table->foriegnId('supplier_id')->references('id')->on('suppliers');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
