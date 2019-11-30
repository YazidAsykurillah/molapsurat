<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisSuratTugas extends Model
{
    protected $table = 'jenis_surat_tugas';
    protected $fillable = [
    	'judul',  'deskripsi'
    ];
}
