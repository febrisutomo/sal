<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sa;
use App\Models\User;
use App\Models\Kitir;
use App\Models\Sppbe;
use App\Models\Armada;
use App\Models\Pangkalan;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
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
            'password' => Hash::make('123')
        ]);

        Armada::factory()->count(4)->create();

        Pangkalan::factory()->count(60)->create();

        $sppbes = [
            [
                'nama' => 'PT Karya Mandiri Sejahtera Utama',
                'kode' => 'KMSU',
                'no_sh' => '758154',
                'plant' => 'G396',
                'alamat' => Faker::create()->address(),
                'no_hp' => Faker::create()->e164PhoneNumber(),
            ],
            [
                'nama' => 'PT Tirtatama Elpiji',
                'kode' => 'TE',
                'no_sh' => '771631',
                'plant' => 'G360',
                'alamat' => Faker::create()->address(),
                'no_hp' => Faker::create()->e164PhoneNumber(),
            ],
            [
                'nama' => 'PT Kusuma Banyumasan Jaya Gas',
                'kode' => 'KBJG',
                'no_sh' => '920810',
                'plant' => 'G39P',
                'alamat' => Faker::create()->address(),
                'no_hp' => Faker::create()->e164PhoneNumber(),
            ],
            [
                'nama' => 'PT Banyumas Gas Abadi',
                'kode' => 'BGA',
                'no_sh' => '945054',
                'plant' => 'G39S',
                'alamat' => Faker::create()->address(),
                'no_hp' => Faker::create()->e164PhoneNumber(),
            ],
        ];

        Sppbe::insert($sppbes);

        $sas = [];
        for ($i=1; $i <= 4; $i++) { 
           $sas[] = [
                'no_sa' => 1059400 + $i,
                'bulan_tahun' => Carbon::create(2022, 10, 1),
                'tipe' => 'reguler',
                'sppbe_id' => $i,
           ];
        }

        Sa::insert($sas);
        

        $kitirs = [];
        for ($i = 1; $i <= 4; $i++) {
            $kuota = collect([560, 1120])->random();
            $kitirs[] = [
                'tanggal' => Carbon::create(2022, 10, 1),
                'no_sa' => 1059400 + $i,
                'kuota' => $kuota,
                'sisa_kuota' => $kuota,
            ];
        };

        Kitir::insert($kitirs);
    }
}
