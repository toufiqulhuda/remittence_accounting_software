<?php
namespace Database\Seeders;
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
            //'address'=> 'Mohammadpur',
            //'mobile' => '01767640344',
            'CreatedBy' => '1',
            'isactive' => '1',
            'roleid'=> '1',
            'ExHouseID'=> '8800030002',
            'EmpId'=> '1',
            'CountryID'=> '1',
            'created_at' => date('Y-m-d H:i:s'),
            'UpdatedBy' => null,
            'updated_at' => null,
        ]);


    }
}
