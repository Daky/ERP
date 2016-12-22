<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Faker\Factory as Faker;
use ERP\UserGroup;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        DB::table('user_groups')->insert([
            'name' => '一級主管'
        ]);
        DB::table('user_groups')->insert([
            'name' => '資訊工程師'
        ]);
        DB::table('user_groups')->insert([
            'name' => '會計人員'
        ]);

        for ($u = 0; $u < 100; $u++) {
            DB::table('users')->insert([
                'account' => str_random(10),
                'name' => str_random(10),
                'password' => bcrypt('secret'),
                'group_id' => DB::table('user_groups')->inRandomOrder()->select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
