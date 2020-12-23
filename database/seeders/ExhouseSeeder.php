<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ExhouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exhouse')->insert([
            'ExHouseID' => '8800030002',
            'ExHouseName' => 'NBL Head Office',
            'ExParentID' => '8800030002',
            'Address' => '18 Dilkusha motijheel',
            'CountryID' => '3',
            'TnxDate' => Carbon::now(),
            'PrevDate' => Carbon::yesterday(),
            'RespExID' => '',
            'ShortName' => '',
            'isactive' => '1',
            //'address'=> 'Mohammadpur',
            //'mobile' => '01767640344',
            'CreatedBy' => '1',
            // 'isactive' => '1',
            // 'roleid'=> '1',
            // 'ExHouseID'=> '1',
            // 'EmpId'=> '1',
            // 'CountryID'=> '1',
            'created_at' => Carbon::now(),
            'UpdatedBy' => null,
            'updated_at' => null,
            'remember_token' => null,
        ]);
    }
}
