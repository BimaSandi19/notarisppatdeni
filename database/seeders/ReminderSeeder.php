<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use faker\Factory as Faker;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

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
            // Distribusi tanggal jatuh tempo (semua masih akan datang):
            // 30% -> 3-7 hari lagi (1/2 minggu)
            // 35% -> 20-35 hari lagi (~1 bulan)
            // 35% -> 50-65 hari lagi (~2 bulan)

            $random = rand(1, 100);

            if ($random <= 30) {
                // 1/2 minggu lagi (3-7 hari)
                $tanggal = Carbon::now()->addDays(rand(3, 7))->format('Y-m-d');
            } elseif ($random <= 65) {
                // ~1 bulan lagi (20-35 hari)
                $tanggal = Carbon::now()->addDays(rand(20, 35))->format('Y-m-d');
            } else {
                // ~2 bulan lagi (50-65 hari)
                $tanggal = Carbon::now()->addDays(rand(50, 65))->format('Y-m-d');
            }

            // Random nominal antara 500.000 - 10.000.000
            $nominal = rand(50, 1000) * 10000;

            $keterangan = $keteranganPending[array_rand($keteranganPending)];

            $data[] = [
                'nama_nasabah' => $faker->name(),
                'nomor_kwitansi' => 'KW' . strtoupper($faker->bothify('########')),
                'nominal_tagihan' => $nominal,
                'tanggal_tagihan' => $tanggal,
                'status_pembayaran' => 'Pending',
                'keterangan' => $keterangan,
                'is_approved' => 0,
                'is_canceled' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data in chunks to avoid memory issues
        foreach (array_chunk($data, 25) as $chunk) {
            DB::table('reminders')->insert($chunk);
        }

        $this->command->info('✅ Successfully seeded 100 reminder records!');
        $this->command->info('📊 All reminders status "Pending" (upcoming only):');
        $this->command->info('   - 30% will be due in 3-7 days (~1/2 week)');
        $this->command->info('   - 35% will be due in 20-35 days (~1 month)');
        $this->command->info('   - 35% will be due in 50-65 days (~2 months)');
    }
}
