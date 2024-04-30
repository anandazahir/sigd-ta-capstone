<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\petikemas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\petikemas>
 */
class PetikemasFactory extends Factory
{
    protected $model = petikemas::class;
    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_petikemas' => $this->faker->sentence,
            'pelayaran' => $this->faker->sentence,
            'jenis_ukuran' => $this->faker->sentence,
            'tanggal_masuk' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'tanggal_keluar' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
