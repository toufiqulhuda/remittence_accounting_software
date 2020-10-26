<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('secret'),
            'name' => 'Md Toufiqul Huda',
            'email' => 'toufiq.it@gmail.com',
            'address'=> 'Mohammadpur',
            'mobile' => '01767640344',
            'created_by' => '1',
            'isactive' => '1',
            'roleid'=> '1',
            'branch_id'=> '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        
    }
}
