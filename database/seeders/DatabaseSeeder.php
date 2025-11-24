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
        // ALWAYS seed admin user (diperlukan untuk login pertama kali di production)
        DB::table('users')->insert([
            'nama' => 'Admin Keuangan',
            'username' => env('ADMIN_USERNAME'),
            'email'          => env('ADMIN_EMAIL'),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'terakhir_login' => null, // Awalnya null sampai user pertama kali login
            'created_at'     => now(),
            'updated_at'     => now(),
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
