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
                'CountryID' => '01',
                'CountryName' => 'America',
                'CurrencyID' => '8',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,
            ],

            [
                'CountryID' => '06',
                'CountryName' => 'Malaysia',
                'CurrencyID' => '2',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,
            ],

            [
                'CountryID' => '65',
                'CountryName' => 'Singapore',
                'CurrencyID' => '1',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,

            ],
            [
                'CountryID' => '960',
                'CountryName' => 'Maldives',
                'CurrencyID' => '3',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,

            ],
            [
                'CountryID' => '968',
                'CountryName' => 'Oman',
                'CurrencyID' => '4',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy'  => null,
                'updated_at' => null,

            ],

        ]);

    }
}
