<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency')->insert([
            [

                'CurrencyName' => 'Singapore Dollar',
                'CountryID' => '065',
                'ShortName' => 'SGD',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,
            ],

            [
                'CurrencyName' => 'Malaysian Ringgit',
                'CountryID' => '060',
                'ShortName' => 'RM',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,
                //timestamps();
            ],

            [
                'CurrencyName' => 'Rufiyaa',
                'CountryID' => '960',
                'ShortName' => 'MRF',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,

            ],
            [
                'CurrencyName' => 'OMR',
                'CountryID' => '968',
                'ShortName' => 'RO',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,

            ],
            [
                'CurrencyName' => 'Euro',
                'CountryID' => '030',
                'ShortName' => 'EURO',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,

            ],
            [
                'CurrencyName' => 'USD',
                'CountryID' => '01',
                'ShortName' => 'USD',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,

            ],
        ]);

    }
}
