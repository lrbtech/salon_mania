<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('salon_id')->nullable()->default('');
            $table->string('customer_id')->nullable()->default('');
            $table->string('order_id')->nullable()->default('');
            $table->string('pay_url')->nullable()->default('');
            $table->string('payment_id')->nullable()->default('');
            $table->string('payment_status')->default('0');
            $table->string('appointment_date')->nullable()->default('');
            $table->string('appointment_time')->nullable()->default('');
            $table->string('workers_id')->nullable()->default('');
            $table->string('coupon_id')->nullable()->default('');
            $table->string('subtotal')->nullable()->default('');
            $table->string('discount')->nullable()->default('');
            $table->string('total')->nullable()->default('');
            $table->string('otp')->nullable()->default('');
            $table->string('address_id')->default('0');
            $table->string('booking_status')->default('0');
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
        Schema::dropIfExists('bookings');
    }
}
