<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Truk;
use App\Models\User;
use App\Models\Kitir;
use App\Models\Sppbe;
use App\Models\Setting;
use App\Models\Pangkalan;
use App\Models\KuotaHarian;
use App\Models\Sa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Febri Sutomo',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'phone' => fake()->e164PhoneNumber(),
        ]);

        User::create([
            'name' => 'Dwi Yuliarto',
            'email' => 'manager@gmail.com',
            'phone' => fake()->e164PhoneNumber(),
            'role' => 'manager',
            'password' => Hash::make('123')
        ]);

        User::create([
            'name' => 'Andi Sofyan',
            'email' => 'pegawai@gmail.com',
            'phone' => fake()->e164PhoneNumber(),
            'role' => 'pegawai',
            'password' => Hash::make('123')
        ]);


        Truk::factory()->count(5)->create();

        foreach (Truk::all() as $truk) {
            $truk->update([
                'kode' => 'SAL-0' . $truk->id
            ]);
        }

        Pangkalan::factory()->count(100)->create();

        $sppbes = [
            [
                'nama' => 'PT Karya Mandiri Sejahtera Utama',
                'kode' => 'KMSU',
                'no_sh' => '758154',
                'plant' => 'G396',
                'alamat' => fake()->address(),
                'no_hp' => fake()->e164PhoneNumber(),
                'lat_lng' => fake()->latitude(-7.511223017989502 - 0.06, -7.511223017989502 + 0.06) . ', ' . fake()->longitude(109.29252259228235 - 0.06,     109.29252259228235 + 0.06),
            ],
            [
                'nama' => 'PT Tirtatama Elpiji',
                'kode' => 'TE',
                'no_sh' => '771631',
                'plant' => 'G360',
                'alamat' => fake()->address(),
                'no_hp' => fake()->e164PhoneNumber(),
                'lat_lng' => fake()->latitude(-7.511223017989502 - 0.06, -7.511223017989502 + 0.06) . ', ' . fake()->longitude(109.29252259228235 - 0.06,     109.29252259228235 + 0.06),

            ],
            [
                'nama' => 'PT Kusuma Banyumasan Jaya Gas',
                'kode' => 'KBJG',
                'no_sh' => '920810',
                'plant' => 'G39P',
                'alamat' => fake()->address(),
                'no_hp' => fake()->e164PhoneNumber(),
                'lat_lng' => fake()->latitude(-7.511223017989502 - 0.06, -7.511223017989502 + 0.06) . ', ' . fake()->longitude(109.29252259228235 - 0.06,     109.29252259228235 + 0.06),

            ],
            [
                'nama' => 'PT Banyumas Gas Abadi',
                'kode' => 'BGA',
                'no_sh' => '945054',
                'plant' => 'G39S',
                'alamat' => fake()->address(),
                'no_hp' => fake()->e164PhoneNumber(),
                'lat_lng' => fake()->latitude(-7.511223017989502 - 0.06, -7.511223017989502 + 0.06) . ', ' . fake()->longitude(109.29252259228235 - 0.06,     109.29252259228235 + 0.06),

            ],
        ];

        Sppbe::insert($sppbes);


        $month_year = date('Y-m');

        $kitir = Kitir::create([
            'bulan_tahun' => $month_year,
        ]);

        foreach (Sppbe::all() as $sppbe) {
            $kitir->sas()->create([
                'no_sa' =>  intval(date('my')) * 1000 + ($sppbe->id * 100),
                'tipe' => 'reguler',
                'sppbe_id' => $sppbe->id,
            ]);
        }

        $sppbes = Sppbe::all()->random(3);
        foreach ($sppbes as $sppbe) {
            $kitir->sas()->create([
                'no_sa' =>  intval(date('my', strtotime($month_year . '-01'))) * 1000 + ($sppbe->id * 100) + 50,
                'tipe' => 'tambahan',
                'sppbe_id' => $sppbe->id,
            ]);
        }

        $kuota_harians = [];

        $count_days = date('t', strtotime($month_year . '-01'));

        for ($i = 1; $i <= $count_days; $i++) {
            $date = date('Y-m-d', strtotime($month_year . '-' . str_pad($i, 2, '0', STR_PAD_LEFT)));
            if (date('N', strtotime($date)) != 7) {
                $num = collect([3, 4])->random();
                $sa_reguler = Sa::where('tipe', 'reguler')->get()->random($num);
                foreach ($sa_reguler as $sa) {
                    $kuota = collect([560, 1120, 1680])->random();
                    $kuota_harians[] = [
                        'tanggal' => $date,
                        'sa_id' => $sa->id,
                        'kuota' => $kuota,
                    ];
                };

                if ($i % 5 == 0) {
                    $sa_tambahan = Sa::where('tipe', 'tambahan')->get()->random();
                    $kuota = 560;
                    $kuota_harians[] = [
                        'tanggal' => $date,
                        'sa_id' => $sa_tambahan->id,
                        'kuota' => $kuota,
                    ];
                }
            }
        }

        KuotaHarian::insert($kuota_harians);


        Setting::create([
            'stok_awal' => 1000,
            'harga' => 14250,
            'nama_manager' => 'Dwi Yuliarto',
            'ttd_manager' => 'ttd-yuli.jpg',
            'nama_perusahaan' => 'PT Serayu Agung Lestari',
            'alamat' => 'Jl. Kulon No. 674 Sudagaran, Banyumas, Jawa Tengah 53192',
            'email' => 'ptserayuagunglestari@gmail.com',
            'telepon' => '0281796009'
        ]);
    }
}
