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
        DB::table('users')->insert([
            'nama' => 'Admin Keuangan',
            'username' => 'keuangandn01',
            'email'          => 'deninugrahakantornotaris@gmail.com',
            'password' => Hash::make('adminkeuangan@dn1'),
            'terakhir_login' => null, // Awalnya null sampai user pertama kali login
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Seed reminders after creating the admin user
        if (class_exists(ReminderSeeder::class)) {
            $this->call(ReminderSeeder::class);
        }
    }
}
