<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salon_roles', function (Blueprint $table) {
            $table->id();
            $table->string('salon_id')->nullable();
            $table->string('role_name')->nullable();
            $table->string('dashboard')->nullable();
            $table->string('appointment')->nullable();
            $table->string('calendor')->nullable();
            $table->string('push_notification')->nullable();
            $table->string('service')->nullable();
            $table->string('review')->nullable();
            $table->string('coupon')->nullable();
            $table->string('workers')->nullable();
            $table->string('reports')->nullable();
            $table->string('roles')->nullable();
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
        Schema::dropIfExists('salon_roles');
    }
}
