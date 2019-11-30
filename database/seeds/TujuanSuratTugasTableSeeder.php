<?php

use Illuminate\Database\Seeder;
use App\TujuanSuratTugas;

class TujuanSuratTugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TujuanSuratTugas::truncate();
        factory(App\TujuanSuratTugas::class, 10)->create();
    }
}
