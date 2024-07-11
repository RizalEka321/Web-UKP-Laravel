<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Kerjasama;
use Illuminate\Database\Eloquent\Factories\Factory;

class KerjasamaFactory extends Factory
{
    protected $model = Kerjasama::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Tanggal mulai minimal tahun 2010
        $startDate = Carbon::create(2010, 1, 1);
        $endDate = now(); // Tanggal saat ini

        return [
            'id_user'       =>  1,
            'id_kategori'   =>  rand(1, 5),
            'nama_instansi' =>  $this->faker->name,
            'contact_person' =>  $this->faker->phoneNumber,
            'nomor_mou'     => $this->faker->phoneNumber,
            'file_mou'     => $this->faker->phoneNumber,
            'jenis_kegiatan'    =>  $this->faker->paragraph(1),
            'tgl_mulai' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'tgl_berakhir' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'created_at'        =>  $this->faker->dateTimeBetween(),
            'kriteria'    =>  $this->faker->paragraph(1),
            'status'    =>  1,
        ];
    }
}
