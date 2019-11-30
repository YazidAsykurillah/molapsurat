<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TujuanSuratTugas extends Model
{
    protected $table ='tujuan_surat_tugas';

    protected $fillable = [
    	'nama', 'alamat'
    ];

    public function surat_tugas()
    {
    	return $this->hasMany('App\SuratTugas');
    }
}
