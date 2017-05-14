<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user
        DB::table('roles')->insert([
            'name'         => '系統管理者',
            'display_name' => '系統管理者',
            'description'  => '系統管理者',
            'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'name'         => '資訊工程師',
            'display_name' => '資訊工程師',
            'description'  => '資訊工程師',
            'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'account'    => 'admin',
            'name'       => '系統',
            'password'   => '1021',
            'email'      => 'ga013077@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);

        //permission_kinds
        DB::table('permission_kinds')->insert([
            'name' => '管理',
            'route_url' => 'manage',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //permission_role
        DB::table('permission_role')->insert([ 'permission_id' => 1, 'role_id' => 1]);
        DB::table('permission_role')->insert([ 'permission_id' => 2, 'role_id' => 1]);
        DB::table('permission_role')->insert([ 'permission_id' => 3, 'role_id' => 1]);

        //permissions
        DB::table('permissions')->insert([
            'name' => '帳號管理', 
            'display_name' => '帳號管理', 
            'description' => '帳號管理', 
            'route_name' => 'manage.users.list',
            'permission_kind_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'name' => '職務管理', 
            'display_name' => '職務管理', 
            'description' => '職務管理', 
            'route_name' => 'manage.roles.list',
            'permission_kind_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'name' => '權限管理', 
            'display_name' => '權限管理', 
            'description' => '權限管理', 
            'route_name' => 'manage.permissions.list',
            'permission_kind_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //得寶紡織廠
        DB::table('permission_kinds')->insert([
            'name' => '得寶',
            'route_url' => 'derbou',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
