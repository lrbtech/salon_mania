<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salon_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('salon_id')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('salon_name')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('salon_passwords');
    }
}
