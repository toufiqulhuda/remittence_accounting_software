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
                'CurrencyName' => 'Malaysian Ringgit',
                'ISO_CODE' => 'MYR',
                'ShortName' => 'RM',
                'isactive' => '0',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,
                //timestamps();
            ],
            [

                'CurrencyName' => 'Singapore Dollar',
                'ISO_CODE' => 'SGD',
                'ShortName' => 'SGD',
                'isactive' => '0',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,
            ],
            [

                'CurrencyName' => 'Bangladesh TK',
                'ISO_CODE' => 'BDT',
                'ShortName' => 'BDT',
                'isactive' => '1',
                'CreatedBy' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'UpdatedBy' => null,
                'updated_at' => null,
            ],




        ]);

    }
}
