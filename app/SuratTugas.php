<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class SuratTugas extends Model
{
    protected $table = 'surat_tugas';

    protected $fillable = [
    	'nomor', 'tanggal', 'jenis_surat_tugas_id', 'uraian', 'tujuan_surat_tugas_id',
    	'tanggal_mulai', 'tanggal_selesai', 'attachment'
    ];

    protected $appends = ['background_type'];

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

    public function getBackgroundTypeAttribute()
    {
        $bg_type = '';
        $status_laporan_surat_tugas = NULL;
        if($this->laporan_surat_tugas){
            $status_laporan_surat_tugas = $this->laporan_surat_tugas->status;
        }

        $tanggal_selesai = Carbon::parse($this->tanggal_selesai);
        $now = Carbon::now();
        $diff = $tanggal_selesai->diffInDays($now);

        if($status_laporan_surat_tugas == 4){
            $bg_type = 'bg-success';
        }else{ //check for diff
            if($diff <= 11){
                $bg_type = 'bg-secondary';
            }elseif($diff <=14){
                $bg_type = 'bg-warning';
            }elseif($bg_type >14){
                $bg_type = 'bg-danger';
            }else{
                $bg_type = 'bg-danger';    
            }
            
        }

        return $bg_type;
    }
}
