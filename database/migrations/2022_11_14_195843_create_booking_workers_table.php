<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_workers', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->default('')->nullable();
            $table->string('worker_id')->default('')->nullable();
            $table->string('name')->default('')->nullable();
            $table->string('email')->default('')->nullable();
            $table->string('phone')->default('')->nullable();
            $table->string('image')->default('')->nullable();
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
        Schema::dropIfExists('booking_workers');
    }
}
