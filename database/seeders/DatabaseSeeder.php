<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // for ($i = 1; $i <= 4; $i++) {
        //     $hargaModal = random_int(1000, 1000000);
        //     $hargaJual = ceil($hargaModal + ($hargaModal * 10 / 100));

        //     DB::table('barangs')->insert([
        //         'kategori_id' => '1',
        //         'tipe_dagangan_id' =>  '1',
        //         'kode' => random_int(1, 10),
        //         'nama' =>  'Barang Dagangan ' . $i,
        //         'modal' =>  $hargaModal,
        //         'harga_jual' =>  $hargaJual,
        //         'foto' =>  'dummy' . $i . '.jpg',
        //         'stock' => random_int(0, 50)
        //     ]);

        //     DB::table('detail_transaksis')->insert([
        //         'transaksi_id' => '1',
        //         'barang_id' => $i,
        //         'kode' => '99',
        //         'modal' => $hargaModal,
        //         'harga_jual' => $hargaJual,
        //         'qty' => $i,
        //         'harga_total' => '50000',
        //     ]);
        // }

        DB::table('tipe_dagangans')->insert([
            'tipe' => 'Dagangan',
            'keterangan' => '-',
        ]);

        DB::table('tipe_dagangans')->insert([
            'tipe' => 'Titipan',
            'keterangan' => 'Titipan orang',
        ]);

        DB::table('kategoris')->insert([
            'kategori' => 'Elektronik',
            'keterangan' => '-',
        ]);

        DB::table('kategoris')->insert([
            'kategori' => 'Alat Tulis Kantor',
            'keterangan' => '-',
        ]);

        DB::table('kategoris')->insert([
            'kategori' => 'Sembako',
            'keterangan' => '-',
        ]);

        // DB::table('pembelis')->insert([
        //     'nama' => 'Alice',
        //     'hutang' => '0',
        // ]);

        // DB::table('transaksis')->insert([
        //     'invoice' => 'INV/' . date('j-m-y') . '/0000',
        //     'pembeli_id' => '1',
        //     'tanggal' => date('j F Y'),
        //     'total_belanja' => '30000',
        //     'total_bayar' => '50000',
        //     'keterangan' => '-',
        // ]);

    }
}
