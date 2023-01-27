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

        for ($i = 1; $i <= 4; $i++) {
            $hargaModal = random_int(1000, 1000000);
            $hargaJual = ceil($hargaModal + ($hargaModal * 10 / 100));

            DB::table('barangs')->insert([
                'kategori_id' => '1',
                'tipe_dagangan_id' =>  '1',
                'kode' => random_int(1, 10),
                'nama' =>  'Barang Dagangan ' . $i,
                'harga_modal' =>  $hargaModal,
                'harga_jual' =>  $hargaJual,
                'foto' =>  'dummy' . $i . '.jpg',
            ]);

            DB::table('detail_transaksis')->insert([
                'transaksi_id' => '1',
                'barang_id' => $i,
                'harga_modal' => $hargaModal,
                'harga_jual' => $hargaJual,
                'qty' => $i,
                'harga_total' => '50000',
            ]);
        }

        DB::table('kategoris')->insert([
            'kategori' => 'Barang testing development',
            'keterangan' => 'Barang testing development',
        ]);

        DB::table('tipe_dagangans')->insert([
            'tipe' => 'Dummy Goods',
            'keterangan' => 'Cuma data dummy',

        ]);

        DB::table('pembelis')->insert([
            'nama' => 'Alice',
            'hutang' => '0',
        ]);

        DB::table('transaksis')->insert([
            'pembeli_id' => '1',
            'total_belanja' => '30000',
            'total_bayar' => '50000',
            'keterangan' => '-',
        ]);
    }
}
