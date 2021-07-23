<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_services', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('salon_id')->nullable();
            $table->string('service_name')->nullable();
            $table->string('duration')->nullable();
            $table->string('price')->nullable();
            $table->string('remark',5000)->nullable();
            $table->string('deny_remark',5000)->nullable();
            $table->string('read_status')->default('0');
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
        Schema::dropIfExists('new_services');
    }
}
