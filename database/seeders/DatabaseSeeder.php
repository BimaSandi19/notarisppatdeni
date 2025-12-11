<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ALWAYS seed admin user
        DB::table('users')->insert([
            // Admin Keuangan
            [
                'nama' => 'Admin Keuangan',
                'username' => config('admin.username'),
                'email' => config('admin.email'),
                'password' => Hash::make(config('admin.password')),
                'terakhir_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Demo accounts untuk dosen
            // Dosen Pembimbing 1
            [
                'nama' => 'Dosen Pembimbing 1',
                'username' => 'pembimbing1',
                'email' => 'hafiz.budi@if.itera.ac.id',
                'password' => Hash::make('pembimbing1@123'),
                'terakhir_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Dosen Pembimbing 2
            [
                'nama' => 'Dosen Pembimbing 2',
                'username' => 'pembimbing2',
                'email' => 'miranti.verdiana@if.itera.ac.id',
                'password' => Hash::make('pembimbing2@123'),
                'terakhir_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Dosen Penguji 1
            [
                'nama' => 'Dosen Penguji 1',
                'username' => 'penguji1',
                'email' => 'firman.ashari@if.itera.ac.id',
                'password' => Hash::make('penguji1@123'),
                'terakhir_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Dosen Penguji 2
            [
                'nama' => 'Dosen Penguji 2',
                'username' => 'penguji2',
                'email' => 'mohamad.idris@if.itera.ac.id',
                'password' => Hash::make('penguji2@123'),
                'terakhir_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ONLY seed testing data in local/development environment
        // Production harus mulai dengan data reminder & history KOSONG
        if (app()->environment('local', 'testing', 'dev')) {
            if (class_exists(ReminderSeeder::class)) {
                $this->call(ReminderSeeder::class);
            }

            if (class_exists(HistorySeeder::class)) {
                $this->call(HistorySeeder::class);
            }
        }
    }
}
