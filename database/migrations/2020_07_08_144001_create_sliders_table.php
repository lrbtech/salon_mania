<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('order')->nullable();
            $table->string('text')->nullable();
            $table->string('button')->nullable();
            $table->string('text_position')->nullable();
            $table->string('text_color')->nullable();
            $table->string('button_color')->nullable();
            $table->string('background_color')->nullable();
            $table->string('indicator_color')->nullable();
            $table->string('slider_image')->nullable();
            $table->string('image_fit')->nullable();
            $table->string('service_id')->nullable();
            $table->string('salon_id')->nullable();
            $table->string('status')->default('0');
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
        Schema::dropIfExists('sliders');
    }
}
