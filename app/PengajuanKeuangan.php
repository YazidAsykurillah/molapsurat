<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanKeuangan extends Model
{
    protected $table = 'pengajuan_keuangan';

    protected $fillable = [
    	'jenis_surat_tugas_id', 'nama_kegiatan', 'tanggal_mulai_kegiatan', 'tanggal_selesai_kegiatan',
        'pic_id', 'jumlah_pengajuan', 'pagu_tahunan_id'
    ];

    public function jenis_surat_tugas()
    {
    	return $this->belongsTo('App\JenisSuratTugas');
    }

    public function pagu_tahunan()
    {
    	return $this->belongsTo('App\PaguTahunan');
    }

    public function pic()
    {
        return $this->belongsTo('App\User', 'pic_id');
    }

    public function realisasi_keuangan()
    {
        return $this->hasOne('App\RealisasiKeuangan');
    }
}
