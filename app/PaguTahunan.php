<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaguTahunan extends Model
{
    protected $table = 'pagu_tahunan';

    protected $fillable = [
    	'tahun', 'jumlah_anggaran'
    ];
}
