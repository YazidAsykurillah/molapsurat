<?php

use Illuminate\Database\Seeder;
use App\SuratTugas;
class SuratTugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuratTugas::truncate();
        factory(App\SuratTugas::class, 3)->create();
    }
}
