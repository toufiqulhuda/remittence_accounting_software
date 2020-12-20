<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuAdminSeeder extends Seeder
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
            [
                'title' => 'Home',
                'url' => '/home',
                'icon' => 'fas fa-home',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Settings',
                'url' => '#',
                'icon' => 'fas fa-cogs',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Menu',
                'url' => '/menus',
                'icon' => 'fas fa-stream',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            // Normal Menu
            [
                'title' => 'Transaction',
                'url' => '#',
                'icon' => '',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Account Transaction',
                'url' => '/transaction/account',
                'icon' => '',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            // HO Menu

        ]);
    }
}
