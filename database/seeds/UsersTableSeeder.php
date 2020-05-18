<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        $data = [
        	['id'=>1, 'name'=>'Yazid Asykurillah', 'email'=>'yazasykurillah@gmail.com', 'password'=>bcrypt('12345')],
        	['id'=>2, 'name'=>'Binar Ilman', 'email'=>'ilman_binar@gmail.com', 'password'=>bcrypt('12345')],
        ];
        \DB::table('users')->insert($data);
    }
}
