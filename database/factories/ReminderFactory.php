<?php

namespace Database\Factories;

use App\Models\Reminder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reminder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = ['Pending', 'Lunas', 'Dibatalkan'];
        $status = $this->faker->randomElement($statuses);

        return [
            'user_id' => 1, // assumes DatabaseSeeder creates a user first
            'nama_nasabah' => $this->faker->name(),
            'nomor_kwitansi' => 'KW' . $this->faker->unique()->numerify('########'),
            'nominal_tagihan' => $this->faker->numberBetween(50000, 5000000),
            'status_pembayaran' => $status,
            'keterangan' => $this->faker->sentence(6),
            'tanggal_tagihan' => $this->faker->dateTimeBetween('-30 days', '+90 days')->format('Y-m-d'),
            'is_canceled' => $status === 'Dibatalkan' ? true : false,
            'is_approved' => $status === 'Lunas' ? true : false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
