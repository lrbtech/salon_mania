<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->nullable();
            $table->string('dashboard')->nullable();
            $table->string('customer_read')->nullable();
            $table->string('customer_create')->nullable();
            $table->string('customer_edit')->nullable();
            $table->string('customer_delete')->nullable();
            $table->string('salon_read')->nullable();
            $table->string('salon_create')->nullable();
            $table->string('salon_edit')->nullable();
            $table->string('salon_delete')->nullable();
            $table->string('category_read')->nullable();
            $table->string('category_create')->nullable();
            $table->string('category_edit')->nullable();
            $table->string('category_delete')->nullable();
            $table->string('salon_package_read')->nullable();
            $table->string('salon_package_create')->nullable();
            $table->string('salon_package_edit')->nullable();
            $table->string('salon_package_delete')->nullable();
            $table->string('review_ratings_read')->nullable();
            $table->string('service_read')->nullable();
            $table->string('service_create')->nullable();
            $table->string('service_edit')->nullable();
            $table->string('service_delete')->nullable();
            $table->string('service_request_read')->nullable();
            $table->string('service_request_update')->nullable();
            $table->string('push_notification_read')->nullable();
            $table->string('push_notification_create')->nullable();
            $table->string('push_notification_edit')->nullable();
            $table->string('push_notification_delete')->nullable();
            $table->string('notification_request_read')->nullable();
            $table->string('notification_request_update')->nullable();
            $table->string('coupon_read')->nullable();
            $table->string('coupon_create')->nullable();
            $table->string('coupon_edit')->nullable();
            $table->string('coupon_delete')->nullable();
            $table->string('coupon_request_read')->nullable();
            $table->string('coupon_request_update')->nullable();
            $table->string('booking_read')->nullable();
            $table->string('area_read')->nullable();
            $table->string('area_create')->nullable();
            $table->string('area_edit')->nullable();
            $table->string('area_delete')->nullable();
            $table->string('chat_to_salon_read')->nullable();
            $table->string('chat_to_customer_read')->nullable();
            $table->string('revenue_reports_read')->nullable();
            $table->string('settlement_reports_read')->nullable();
            $table->string('user_read')->nullable();
            $table->string('user_create')->nullable();
            $table->string('user_edit')->nullable();
            $table->string('user_delete')->nullable();
            $table->string('roles_read')->nullable();
            $table->string('roles_create')->nullable();
            $table->string('roles_edit')->nullable();
            $table->string('roles_delete')->nullable();
            $table->string('slider_read')->nullable();
            $table->string('slider_create')->nullable();
            $table->string('slider_edit')->nullable();
            $table->string('slider_delete')->nullable();
            $table->string('banner_read')->nullable();
            $table->string('banner_create')->nullable();
            $table->string('banner_edit')->nullable();
            $table->string('banner_delete')->nullable();
            $table->string('application_settings_read')->nullable();
            $table->string('terms_and_condition_read')->nullable();
            $table->string('settlement_period_read')->nullable();
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
        Schema::dropIfExists('roles');
    }
}
