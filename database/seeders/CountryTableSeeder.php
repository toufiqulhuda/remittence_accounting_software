<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('country')->insert([


            [
                'CountryCode' => '060',
                'CountryName' => 'Malaysia',
                'iso_code' => 'MYS',
                'CurrencyID' => '1',
                'isactive' => '0',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,
            ],

            [
                'CountryCode' => '065',
                'CountryName' => 'Singapore',
                'iso_code' => 'SGP',
                'CurrencyID' => '2',
                'isactive' => '0',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,

            ],
            [
                'CountryCode' => '880',
                'CountryName' => 'Bangladesh',
                'iso_code' => 'BDT',
                'CurrencyID' => '3',
                'isactive' => '1',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,

            ],


        ]);

    }
}
