<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Admin',
                'isactive' => '1',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],

            [
                'role_name' => 'Head_Office',
                'isactive' => '0',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                //timestamps();
            ],

            [
                'role_name' => 'Normal',
                'isactive' => '0',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                //timestamps(),

            ],
        ]);

    }
}
