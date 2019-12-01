<?php

use Illuminate\Database\Seeder;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Block table roles
	    DB::table('roles')->delete();
        $roles = [
        	['id'=>1, 'code'=>'SUP', 'name'=>'Super Admin', 'label'=>'User with this role  has full access to apllication'],
        	['id'=>2, 'code'=>'ADM', 'name'=>'Administrator', 'label'=>'User with this role  has almost full access to apllication'],
        ];
        DB::table('roles')->insert($roles);
	    //ENDBlock table roles

        //Block table role_user
	    DB::table('role_user')->delete();
        $role_user = [
        	//Super Admin
        	['role_id'=>1, 'user_id'=>1],

        	//Administrator
			['role_id'=>2, 'user_id'=>2],
        ];
        DB::table('role_user')->insert($role_user);
        //ENDBlock table role_user

        //Block table permissions
        DB::table('permissions')->delete();
        $permissions = [
            //Access Master Data
            [ 'id'=>1 ,'slug'=>'access-master-data', 'description'=>'View Master Data Menu'],

        ];
        DB::table('permissions')->insert($permissions);
        //ENDBlock table permissions

        //Block table permission_role
        DB::table('permission_role')->delete();
        $permission_role = [
        	//Administrator privilleges
        	['permission_id'=>1, 'role_id'=>2],
        ];
        DB::table('permission_role')->insert($permission_role);
        //ENDBlock table permission_role
    }
}
