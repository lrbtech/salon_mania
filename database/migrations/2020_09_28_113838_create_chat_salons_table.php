<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_salons', function (Blueprint $table) {
            $table->id();
            $table->string('salon_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('message_from')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->TEXT('text')->nullable();
            $table->string('staus')->default('0');
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
        Schema::dropIfExists('chat_salons');
    }
}
