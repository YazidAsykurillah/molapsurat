<?php

use Faker\Generator as Faker;

$factory->define(App\JenisSuratTugas::class, function (Faker $faker) {
    return [
        'judul' => $faker->unique()->name,
        'deskripsi' => $faker->paragraph,
    ];
});
