<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('busisness_type')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('password')->nullable();
            $table->string('salon_name')->nullable();
            $table->string('salon_id')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('address',5000)->nullable();
            $table->string('nationality')->nullable();
            $table->string('country_id')->nullable();
            $table->string('emirates_id')->nullable();
            $table->string('trade_license_no')->nullable();
            $table->string('vat_certificate_no')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('salon_package')->nullable();
            $table->string('used_package_id')->nullable();
            $table->string('active_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('remind_date')->nullable();
            $table->string('salon_commission')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('trade_license')->nullable();
            $table->string('passport_copy')->nullable();
            $table->string('emirated_id_copy')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->TEXT('signature_data',30000)->nullable();
            $table->string('login_status')->default('0');
            $table->string('status')->default('0');
            $table->string('user_id')->nullable();
            $table->string('role_id')->nullable();
            $table->string('service_ids')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('iban_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('salon_pay')->nullable();
            $table->string('salon_paid')->nullable();
            $table->string('salon_balance')->nullable();
            $table->string('admin_pay')->nullable();
            $table->string('admin_paid')->nullable();
            $table->string('admin_balance')->nullable();
            $table->string('account_name')->nullable();
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
        Schema::dropIfExists('users');
    }
}
