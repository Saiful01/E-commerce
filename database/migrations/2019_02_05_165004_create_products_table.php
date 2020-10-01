<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->string('product_slug')->nullable();
            $table->string('product_')->nullable();
            $table->text('product_details')->nullable();
            $table->double('regular_price');
            $table->double('selling_price');
            $table->double('discount_rate')->nullable();
            $table->string('brand_id');
            $table->string('product_measurement')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('featured_product')->default(false);
            $table->boolean('publish_status')->default(true);
            $table->integer('minimum_qnt_order')->default(1);
            $table->unsignedInteger('product_category_id');
            $table->longText('keywords')->nullable();
            $table->timestamps();
            $table->foreign('product_category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
