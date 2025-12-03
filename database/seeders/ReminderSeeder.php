<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh nama. Dipakai random supaya data tetap bervariasi
        $namaNasabahList = [
            'Budi Santoso',
            'Siti Aminah',
            'Andi Pratama',
            'Dewi Lestari',
            'Rudi Hartono',
            'Rina Kurniawati',
            'Ahmad Fauzi',
            'Kartika Sari',
            'Yusuf Maulana',
            'Lia Wulandari',
        ];

        $keteranganPending = [
            'Menunggu konfirmasi pembayaran.',
            'Tagihan belum dibayar.',
            'Segera lakukan pembayaran.',
            'Pembayaran tertunda.',
            'Menunggu transfer dari nasabah.',
            'Belum ada konfirmasi pembayaran.',
            'Tagihan jatuh tempo segera.',
            'Mohon segera dilunasi.',
            'Pembayaran dalam proses verifikasi.',
            'Menunggu pelunasan.',
        ];

        $data = [];

        for ($i = 1; $i <= 100; $i++) {

            // Distribusi tanggal jatuh tempo (semua di masa depan):
            // 30% -> 3-7 hari lagi
            // 35% -> 20-35 hari lagi
            // 35% -> 50-65 hari lagi
            $random = rand(1, 100);

            if ($random <= 30) {
                $tanggal = Carbon::now()->addDays(rand(3, 7));
            } elseif ($random <= 65) {
                $tanggal = Carbon::now()->addDays(rand(20, 35));
            } else {
                $tanggal = Carbon::now()->addDays(rand(50, 65));
            }

            // Nominal antara 500.000 – 10.000.000
            $nominal = rand(50, 1000) * 10000;

            $keterangan   = $keteranganPending[array_rand($keteranganPending)];
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
                'tanggal_tagihan'   => $tanggal->format('Y-m-d'),
                'status_pembayaran' => 'Pending',
                'keterangan'        => $keterangan,
                'is_approved'       => 0,
                'is_canceled'       => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        // Insert per 25 row untuk efisiensi
        foreach (array_chunk($data, 25) as $chunk) {
            DB::table('reminders')->insert($chunk);
        }

        $this->command?->info('✅ Successfully seeded 100 reminder records!');
        $this->command?->info('📊 All reminders status "Pending" (upcoming only):');
        $this->command?->info('   - 30% will be due in 3-7 days (~1/2 week)');
        $this->command?->info('   - 35% will be due in 20-35 days (~1 month)');
        $this->command?->info('   - 35% will be due in 50-65 days (~2 months)');
    }
}
