<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataKeuangan;


class GajiKaryawan extends Model
{
    protected $table = 'table_gaji';
     protected $primaryKey = 'id_gaji';
    protected $fillable = [
        'nama',
        'jumlah',
        'tanggal',
        'keterangan',
        'id_keuangan',
    ];

    
public function keuangan()
{
    return $this->belongsTo(DataKeuangan::class, 'id_keuangan');
}

}
