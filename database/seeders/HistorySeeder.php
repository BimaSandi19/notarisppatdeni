<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        // Contoh nama untuk variasi (tanpa Faker)
        $namaNasabahList = [
            'Budi Santoso', 'Siti Aminah', 'Andi Pratama', 'Dewi Lestari',
            'Rudi Hartono', 'Rina Kurniawati', 'Ahmad Fauzi', 'Kartika Sari',
            'Yusuf Maulana', 'Lia Wulandari'
        ];

        $data = [];

        for ($i = 1; $i <= 100; $i++) {

            $status = $statuses[array_rand($statuses)];

            // Tanggal 1—365 hari ke belakang (riwayat)
            $tanggal = Carbon::now()->subDays(rand(1, 365))->format('Y-m-d');

            // Nominal 500.000 – 10.000.000
            $nominal = rand(50, 1000) * 10000;

            // Keterangan sesuai status
            $keterangan = $status === 'Lunas'
                ? $keteranganLunas[array_rand($keteranganLunas)]
                : $keteranganDibatalkan[array_rand($keteranganDibatalkan)];

            $namaNasabah  = $namaNasabahList[array_rand($namaNasabahList)];

            // Format: DN-YY/MM/NNN (contoh: DN-23/XI/129)
            $tahun = date('y');
            $bulan = rand(1, 12);
            $nomorUrut = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            $nomorKwitansi = 'DN-' . $tahun . '/' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '/' . $nomorUrut;

            $data[] = [
                'nama_nasabah'      => $namaNasabah,
                'nomor_kwitansi'    => $nomorKwitansi,
                'nominal_tagihan'   => $nominal,
                'tanggal_tagihan'   => $tanggal,
                'status_pembayaran' => $status,
                'keterangan'        => $keterangan,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        // Insert batch
        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('history')->insert($chunk);
        }

        $this->command?->info('✅ Successfully seeded 100 history records!');
        $this->command?->info('📊 Status breakdown: random approx. 50% Lunas, 50% Dibatalkan');
    }
}
