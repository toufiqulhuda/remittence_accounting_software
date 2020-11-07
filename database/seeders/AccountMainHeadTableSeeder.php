<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountMainHeadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_main_head')->insert([
            [
                'AccHdID'   => '1',
                'AcctHdName' => 'Asset',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'AccHdID'   => '2',
                'AcctHdName' => 'Liability',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                //timestamps();
            ],

            [
                'AccHdID'   => '3',
                'AcctHdName' => 'Income',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                //timestamps(),

            ],
            [
                'AccHdID'   => '4',
                'AcctHdName' => 'Expenditure',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                //timestamps(),

            ],
        ]);
    }
}
