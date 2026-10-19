<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budidaya extends Model
{
    use HasFactory;

    protected $table = 'budidaya';
    protected $primaryKey = 'id_budidaya';

    protected $fillable = [
        'nama_kolam',
        'jenis_ikan',
        'tanggal_tebar',
        'jumlah_bibit',
        'pakan_perhari',
        'umur_ikan',
        'perkiraan_panen',
        'status',
        'keterangan',
    ];
}
