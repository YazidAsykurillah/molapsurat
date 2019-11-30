<?php

use Faker\Generator as Faker;

$factory->define(App\SuratTugas::class, function (Faker $faker) {
    return [
        'nomor'=>$faker->numerify('ST ###'),
        'tanggal'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'jenis_surat_tugas_id'=>\App\JenisSuratTugas::orderBy(\DB::raw('RAND()'))->first()->id,
        'uraian'=>$faker->paragraph,
        'tujuan_surat_tugas_id'=>\App\TujuanSuratTugas::orderBy(\DB::raw('RAND()'))->first()->id,
        'tanggal_mulai'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'tanggal_selesai'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'attachment'=>NULL,
    ];
});
