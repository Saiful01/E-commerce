<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->increments('sell_id');
            $table->string('sell_invoice');
            $table->double('sub_total_price');
            $table->double('shipping_cost');
            $table->double('vat')->default(0);
            $table->double('total');
            $table->double('paid_amount')->default(0);
            $table->double('coupon')->default(0);
            $table->double('discount')->default(0);
            $table->unsignedInteger('customer_id');
            $table->integer('delivery_status')->default(0);  //0=pending, 1=Done, 2=Cancel
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
}
