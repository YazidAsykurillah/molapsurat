<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanKeuangan extends Model
{
    protected $table = 'pengajuan_keuangan';

    protected $fillable = [
    	'surat_tugas_id', 'jumlah_pengajuan', 'pagu_tahunan_id'
    ];

    public function surat_tugas()
    {
    	return $this->belongsTo('App\SuratTugas');
    }

    public function pagu_tahunan()
    {
    	return $this->belongsTo('App\PaguTahunan');
    }
}
