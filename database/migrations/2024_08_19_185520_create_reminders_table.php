<?php
// File: database/migrations/xxxx_xx_xx_xxxxxx_create_reminders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Tambahkan kolom user_id
            $table->string('nama_nasabah')->nullable();
            $table->string('nomor_kwitansi')->nullable();
            $table->integer('nominal_tagihan')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal_tagihan')->nullable();
            $table->boolean('is_canceled')->default(false); // Tambahkan kolom is_canceled
            $table->boolean('is_approved')->default(false); // Tambahkan kolom is_approved
            $table->timestamps();

            // Tambahkan foreign key constraint jika diperlukan
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};