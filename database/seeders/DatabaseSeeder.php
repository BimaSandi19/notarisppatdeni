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
