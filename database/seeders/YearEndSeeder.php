<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class YearEndSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('year_closing_details')->insert([
            //Asset
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10101001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10102001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10201001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10301001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10301002',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10302001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10302002',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'10401001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            //Liability
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'20101001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'20201001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'20301001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'20301002',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'20302001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            //Income
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'30101001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],

            [
                'Type_name'=>'Year Closing',
                'COACode'=>'30102001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            //Expense
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'40101001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'40201001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],
            [
                'Type_name'=>'Year Closing',
                'COACode'=>'40301001',
                'Balance'=>'0.00',
                'ExHouseID'=>'0650020001',
                'Year_Closing_Date'=>Carbon::now(),
                'Year_Closing_Execution'=>Carbon::now(),
                'CreatedBy'=>'1',
                'created_at'=>Carbon::now()
            ],

        ]);
    }
}
