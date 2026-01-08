<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mahasiswa;
use App\Models\BidangKeahlian;
use App\Models\Kelas;

class MahasiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mahasiswa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['Laki-laki', 'Perempuan']);
        $year = $this->faker->numberBetween(2022, 2024);
        
        // Try to get random IDs, or fallback to null if tables are empty
        $bidangKeahlianId = BidangKeahlian::inRandomOrder()->first()?->id_bidang_keahlian;
        $kelasId = Kelas::inRandomOrder()->first()?->id_kelas;

        return [
            'nipd' => $year . '0' . $this->faker->unique()->numberBetween(10000, 99999),
            'nama' => $this->faker->name($gender == 'Laki-laki' ? 'male' : 'female'),
            'jenis_kelamin' => $gender,
            'tempat_lahir' => $this->faker->city(),
            'tgl_lahir' => $this->faker->date('Y-m-d', '2006-01-01'),
            'id_bidang_keahlian' => $bidangKeahlianId,
            'kelas' => $this->faker->regexify('[A-Z]{2}-[1-3][A-B]'), // Fallback string if needed
            'angkatan' => (string) $year,
            'periode' => $year . '/' . ($year + 1) . '/' . $this->faker->numberBetween(1, 8),
            'email' => $this->faker->unique()->safeEmail(),
            'alamat' => $this->faker->address(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
            'no_tlp' => str_replace(['+', ' ', '(', ')', '-'], '', $this->faker->e164PhoneNumber()),
            'foto' => 'default.jpg',
            'status' => 'Aktif',
            'id_kelas' => $kelasId,
        ];
    }
}
