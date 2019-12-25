<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealisasiKeuangan extends Model
{
    protected $table = 'realisasi_keuangan';

    protected $fillable = ['pengajuan_keuangan_id', 'jumlah_realisasi'];

    public function pengajuan_keuangan()
    {
    	return $this->belongsTo('App\PengajuanKeuangan');
    }
}
