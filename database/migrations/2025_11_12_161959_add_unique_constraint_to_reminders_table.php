<?php

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
        Schema::table('reminders', function (Blueprint $table) {
            // Tambahkan UNIQUE composite constraint
            // Kombinasi: nomor_kwitansi + nama_nasabah + tanggal_tagihan
            // Ini mencegah duplikat tagihan yang sama persis
            $table->unique(
                ['nomor_kwitansi', 'nama_nasabah', 'tanggal_tagihan'],
                'unique_reminder_constraint'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            // Hapus unique constraint saat rollback
            $table->dropUnique('unique_reminder_constraint');
        });
    }
};
