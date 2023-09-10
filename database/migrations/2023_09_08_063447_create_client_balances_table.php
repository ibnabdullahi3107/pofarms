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
        Schema::create('client_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('company_id');
            $table->decimal('amount',10,1);



            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->text('description');

            /*
            Client Statement of account pseudo code algo
            $dbtsales= Sales::where('paid_amount'<'amount')->where('status'='')
            loop
            calculate the remaining balance alternatively use query to calculate;
            $debt_balance= $result;
            end loop


            $client_payment= sum(ClientBalance('amount')->all()->where('id'='client_id'));

            $balance=$client_payment -  $debt_balance;



            */



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_balances');
    }
};
