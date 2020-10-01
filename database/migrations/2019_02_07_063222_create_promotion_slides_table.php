<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_slides', function (Blueprint $table) {
            $table->increments('promotion_id');
            $table->string('promotion_image')->nullable();
            $table->string('promotion_name')->nullable();
            $table->string('promotion_url')->nullable();
            $table->boolean('publish_status')->default(true);
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
        Schema::dropIfExists('promotion_slides');
    }
}
