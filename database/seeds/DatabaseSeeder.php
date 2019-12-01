<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AclTableSeeder::class);
        $this->call(JenisSuratTugasTableSeeder::class);
        $this->call(TujuanSuratTugasTableSeeder::class);
        $this->call(SuratTugasTableSeeder::class);
    }
}
