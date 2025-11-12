<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nasabah');
            $table->string('nomor_kwitansi');
            $table->string('nominal_tagihan');
            $table->string('status_pembayaran');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_tagihan');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
