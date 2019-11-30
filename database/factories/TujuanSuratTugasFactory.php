<?php

use Faker\Generator as Faker;

$factory->define(App\TujuanSuratTugas::class, function (Faker $faker) {
    return [
        'nama' => $faker->unique()->company,
        'alamat' => $faker->address,
    ];
});
