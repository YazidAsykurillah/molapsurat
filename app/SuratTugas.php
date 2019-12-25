<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    protected $table = 'surat_tugas';

    protected $fillable = [
    	'nomor', 'tanggal', 'jenis_surat_tugas_id', 'uraian', 'tujuan_surat_tugas_id',
    	'tanggal_mulai', 'tanggal_selesai', 'attachment'
    ];


    public function jenis_surat_tugas()
    {
    	return $this->belongsTo('\App\JenisSuratTugas')->withDefault();
    }

    public function tujuan_surat_tugas()
    {
    	return $this->belongsTo('App\TujuanSuratTugas')->withDefault();
    }

    public function laporan_surat_tugas()
    {
        return $this->hasOne('App\LaporanSuratTugas');
    }
    
    public function users(){
        return $this->belongsToMany('App\User', 'surat_tugas_user')->withPivot('position');
    }
}
