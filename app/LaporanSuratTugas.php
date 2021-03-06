<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanSuratTugas extends Model
{
    protected $table = 'laporan_surat_tugas';

    protected $fillable = [
    	'surat_tugas_id', 'tanggal_approve_ketua_tim', 'tanggal_approve_pengendali_mutu',
    	'tanggal_approve_pengendali_teknis', 'attachment', 'status', 'nomor_routing_slip', 'attachment_routing_slip'
    ];

    public function surat_tugas()
    {
    	return $this->belongsTo('App\SuratTugas')->withDefault();
    }
}
