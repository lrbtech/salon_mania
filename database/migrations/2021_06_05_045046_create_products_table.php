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
            $table->id();
            $table->string('date')->nullable();
            $table->string('salon_id')->nullable();
            $table->string('product_name_english')->nullable();
            $table->string('product_name_arabic')->nullable();
            $table->string('price')->nullable();
            $table->TEXT('description')->nullable();
            $table->string('image')->nullable();
            $table->string('service_ids')->nullable();
            $table->TEXT('remark')->nullable();
            $table->TEXT('deny_remark')->nullable();
            $table->string('read_status')->default('0');
            $table->string('exclusive')->default('0');
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
        Schema::dropIfExists('products');
    }
}
