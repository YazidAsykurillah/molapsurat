<?php

use Illuminate\Database\Seeder;

use App\JenisSuratTugas;
class JenisSuratTugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisSuratTugas::truncate();
        factory(App\JenisSuratTugas::class, 10)->create();
    }
}
