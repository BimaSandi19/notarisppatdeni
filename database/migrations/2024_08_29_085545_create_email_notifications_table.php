<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('email_notification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reminders_id');
            $table->string('email_tujuan');
            $table->string('email_kirim');
            $table->timestamps();
            $table->foreign('reminders_id')->references('id')->on('reminders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_notification');
    }
};
