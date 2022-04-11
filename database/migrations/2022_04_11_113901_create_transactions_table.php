<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name', 128);
            $table->string('vendor_image', 128);
            $table->float('total_amount');
            $table->foreignId('user_id', 64);
            $table->foreignId('card_id', 64);
            $table->string('order_id', 64);
            $table->text('order_details')->nullable();
            $table->text('transaction_details')->nullable();
            $table->string('status', 64);
            $table->timestamps();
        });

        Schema::table('transactions', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('card_id')->references('id')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
