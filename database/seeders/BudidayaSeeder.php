<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudidayaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('budidaya')->insert([
            [
                'nama_kolam' => 'Kolam Lele 1',
                'jenis_ikan' => 'Lele Dumbo',
                'tanggal_tebar' => '2025-10-01',
                'jumlah_bibit' => 5000,
                'pakan_perhari' => 3.5,
                'umur_ikan' => 30,
                'perkiraan_panen' => '2025-12-20',
                'status' => 'aktif',
                'keterangan' => 'Kolam dalam kondisi baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kolam' => 'Kolam Nila 2',
                'jenis_ikan' => 'Nila Merah',
                'tanggal_tebar' => '2025-09-15',
                'jumlah_bibit' => 3000,
                'pakan_perhari' => 2.8,
                'umur_ikan' => 60,
                'perkiraan_panen' => '2025-11-25',
                'status' => 'panen',
                'keterangan' => 'Sudah siap panen minggu depan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kolam' => 'Kolam Gurame 3',
                'jenis_ikan' => 'Gurame',
                'tanggal_tebar' => '2025-08-20',
                'jumlah_bibit' => 2000,
                'pakan_perhari' => 4.2,
                'umur_ikan' => 80,
                'perkiraan_panen' => '2025-12-10',
                'status' => 'aktif',
                'keterangan' => 'Pertumbuhan stabil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
