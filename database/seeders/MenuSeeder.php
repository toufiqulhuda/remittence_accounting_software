<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            // Admin Menu
            //1
            [
                'title' => 'Home',
                'url' => '/home',
                'icon' => 'fas fa-home',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //2
            [
                'title' => 'Settings',
                'url' => '#',
                'icon' => 'fas fa-cogs',
                'roleid' => '1',
                'order' => '2',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //3
            [
                'title' => 'Users',
                'url' => '/users',
                'icon' => 'fas fa-users',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //4
            [
                'title' => 'Role',
                'url' => '/roles',
                'icon' => 'fas fa-users-cog',
                'roleid' => '1',
                'order' => '2',
                'parent_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //5
            [
                'title' => 'Country',
                'url' => '/countries',
                'icon' => 'fas fa-flag-usa',
                'roleid' => '1',
                'order' => '3',
                'parent_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //6
            [
                'title' => 'Currency',
                'url' => '/currencies',
                'icon' => 'fas fa-dollar-sign',
                'roleid' => '1',
                'order' => '4',
                'parent_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //7
            [
                'title' => 'Exhouse',
                'url' => '/exhouses',
                'icon' => 'fas fa-store',
                'roleid' => '1',
                'order' => '5',
                'parent_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //8
            [
                'title' => 'Menu',
                'url' => '/menus',
                'icon' => 'fas fa-stream',
                'roleid' => '1',
                'order' => '6',
                'parent_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],

            // Normal Menu 9
            [
                'title' => 'Home',
                'url' => '/home',
                'icon' => 'fas fa-home',
                'roleid' => '3',
                'order' => '1',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //10
            [
                'title' => 'Transaction',
                'url' => '#',
                'icon' => '',
                'roleid' => '3',
                'order' => '2',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //11
            [
                'title' => 'Account Transaction',
                'url' => '/transaction/account',
                'icon' => '',
                'roleid' => '3',
                'order' => '1',
                'parent_id' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //12
            [
                'title' => 'Reverse Transaction',
                'url' => '/transaction/reverse',
                'icon' => '',
                'roleid' => '3',
                'order' => '2',
                'parent_id' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //13
            [
                'title' => 'Reports',
                'url' => '#',
                'icon' => 'far fa-file-alt',
                'roleid' => '3',
                'order' => '3',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //14
            [
                'title' => "Today's Report",
                'url' => '/todaysRpt',
                'icon' => 'far fa-file-alt',
                'roleid' => '3',
                'order' => '1',
                'parent_id' => '13',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //15
            [
                'title' => "Reports As on Date",
                'url' => '/rptAsOnDate',
                'icon' => 'far fa-file-alt',
                'roleid' => '3',
                'order' => '2',
                'parent_id' => '13',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //16
            [
                'title' => "House Keeping Report",
                'url' => '/houseKeepingRpt/pdf',
                'icon' => 'far fa-file-alt',
                'roleid' => '3',
                'order' => '3',
                'parent_id' => '13',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],

            // HO Menu 17
            [
                'title' => 'Home',
                'url' => '/home',
                'icon' => 'fas fa-home',
                'roleid' => '2',
                'order' => '1',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //18
            [
                'title' => 'House Keeping',
                'url' => '#',
                'icon' => '',
                'roleid' => '2',
                'order' => '2',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //19
            [
                'title' => 'Group Accounts',
                'url' => '/groupAccount',
                'icon' => '',
                'roleid' => '2',
                'order' => '1',
                'parent_id' => '18',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //20
            [
                'title' => 'Sub Group Accounts',
                'url' => '/subGroupAccount',
                'icon' => '',
                'roleid' => '2',
                'order' => '2',
                'parent_id' => '18',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //21
            [
                'title' => 'Chart of Accounts',
                'url' => '/chartOfAccount',
                'icon' => '',
                'roleid' => '2',
                'order' => '3',
                'parent_id' => '18',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //22
            [
                'title' => 'Employee Information',
                'url' => '#',
                'icon' => '',
                'roleid' => '2',
                'order' => '4',
                'parent_id' => '18',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            // reports 23
            [
                'title' => 'Reports',
                'url' => '#',
                'icon' => 'far fa-file-alt',
                'roleid' => '2',
                'order' => '3',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //24
            [
                'title' => "Today's Report",
                'url' => '/todaysRpt',
                'icon' => 'far fa-file-alt',
                'roleid' => '2',
                'order' => '1',
                'parent_id' => '23',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //25
            [
                'title' => "Reports As on Date",
                'url' => '/rptAsOnDate',
                'icon' => 'far fa-file-alt',
                'roleid' => '2',
                'order' => '2',
                'parent_id' => '23',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //26
            [
                'title' => "House Keeping Report",
                'url' => '/houseKeepingRpt/pdf',
                'icon' => 'far fa-file-alt',
                'roleid' => '2',
                'order' => '3',
                'parent_id' => '23',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //27
            [
                'title' => "Maintenance",
                'url' => '#',
                'icon' => 'fas fa-tools',
                'roleid' => '2',
                'order' => '4',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //28
            [
                'title' => "Reset Password",
                'url' => '/users-search',
                'icon' => 'fas fa-key',
                'roleid' => '2',
                'order' => '1',
                'parent_id' => '27',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //29
            [
                'title' => 'Settings',
                'url' => '#',
                'icon' => 'fas fa-cogs',
                'roleid' => '2',
                'order' => '5',
                'parent_id' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //30
            [
                'title' => 'Users',
                'url' => '/users',
                'icon' => 'fas fa-users',
                'roleid' => '2',
                'order' => '1',
                'parent_id' => '29',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //31
            [
                'title' => 'Role',
                'url' => '/roles',
                'icon' => 'fas fa-users-cog',
                'roleid' => '2',
                'order' => '2',
                'parent_id' => '29',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //32
            [
                'title' => 'Country',
                'url' => '/countries',
                'icon' => 'fas fa-flag-usa',
                'roleid' => '2',
                'order' => '3',
                'parent_id' => '29',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //33
            [
                'title' => 'Currency',
                'url' => '/currencies',
                'icon' => 'fas fa-dollar-sign',
                'roleid' => '2',
                'order' => '4',
                'parent_id' => '29',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //34
            [
                'title' => 'Exhouse',
                'url' => '/exhouses',
                'icon' => 'fas fa-store',
                'roleid' => '2',
                'order' => '5',
                'parent_id' => '29',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //35
            [
                'title' => 'Menu',
                'url' => '/menus',
                'icon' => 'fas fa-stream',
                'roleid' => '2',
                'order' => '6',
                'parent_id' => '29',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //36
            [
                'title' => 'End Of Day',
                'url' => '/endOfDay',
                'icon' => '',
                'roleid' => '3',
                'order' => '3',
                'parent_id' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            //37
            [
                'title' => 'Year Closing',
                'url' => '/yearClosing',
                'icon' => 'fas fa-calendar-alt',
                'roleid' => '2',
                'order' => '2',
                'parent_id' => '27',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],



        ]);
    }
}

