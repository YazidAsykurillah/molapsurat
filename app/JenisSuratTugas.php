<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisSuratTugas extends Model
{
    protected $table = 'jenis_surat_tugas';
    protected $fillable = [
    	'judul',  'deskripsi'
    ];


    public function surat_tugas()
    {
    	return $this->hasMany('App\SuratTugas');
    }
}
