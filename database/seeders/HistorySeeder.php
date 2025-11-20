<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $statuses = ['Lunas', 'Dibatalkan'];

        $keteranganLunas = [
            'Pembayaran lunas tepat waktu.',
            'Sudah dibayar penuh.',
            'Lunas melalui transfer bank.',
            'Pembayaran cash sudah diterima.',
            'Lunas via mobile banking.',
            'Sudah lunas, terima kasih.',
            'Pembayaran lengkap diterima.',
            'Lunas sesuai invoice.',
        ];

        $keteranganDibatalkan = [
            'Dibatalkan karena kesalahan input.',
            'Tagihan tidak valid.',
            'Nasabah meminta pembatalan.',
            'Duplikasi data.',
            'Kesalahan sistem.',
            'Data tidak sesuai.',
            'Dibatalkan atas permintaan nasabah.',
            'Revisi tagihan diperlukan.',
        ];

        $data = [];

        for ($i = 1; $i <= 100; $i++) {
            $status = $statuses[array_rand($statuses)];
            $tanggal = Carbon::now()->subDays(rand(1, 365))->format('Y-m-d');

            // Random nominal antara 500.000 - 10.000.000
            $nominal = rand(50, 1000) * 10000;

            // Pilih keterangan sesuai status
            if ($status === 'Lunas') {
                $keterangan = $keteranganLunas[array_rand($keteranganLunas)];
            } else {
                $keterangan = $keteranganDibatalkan[array_rand($keteranganDibatalkan)];
            }

            $data[] = [
                'nama_nasabah' => $faker->name(),
                'nomor_kwitansi' => 'KW' . strtoupper($faker->bothify('########')),
                'nominal_tagihan' => $nominal,
                'tanggal_tagihan' => $tanggal,
                'status_pembayaran' => $status,
                'keterangan' => $keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data in chunks to avoid memory issues
        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('history')->insert($chunk);
        }

        $this->command->info('✅ Successfully seeded 100 history records!');
        $this->command->info('📊 Status breakdown will be random (approximately 50% Lunas, 50% Dibatalkan)');
    }
}
