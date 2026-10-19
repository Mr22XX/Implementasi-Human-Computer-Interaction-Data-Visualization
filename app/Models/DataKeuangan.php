<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GajiKaryawan;


class DataKeuangan extends Model
{
    use HasFactory;

    protected $table = 'data_keuangan';
    protected $primaryKey = 'id_keuangan';

    protected $fillable = [
        'jenis',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    public function gaji()
{
    return $this->hasOne(GajiKaryawan::class, 'id_keuangan');
}

}

