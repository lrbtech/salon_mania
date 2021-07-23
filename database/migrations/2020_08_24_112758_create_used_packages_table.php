<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsedPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_id')->nullable();
            $table->string('salon_id')->nullable();
            $table->string('package_name')->nullable();
            $table->string('price')->nullable();
            $table->string('duration_period')->nullable();
            $table->string('duration')->nullable();
            $table->string('no_of_service')->default('0');
            $table->string('no_of_product')->default('0');
            $table->string('no_of_package')->default('0');
            $table->string('image')->nullable();
            $table->string('apply_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('no_of_days')->default('0');
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
        Schema::dropIfExists('used_packages');
    }
}
