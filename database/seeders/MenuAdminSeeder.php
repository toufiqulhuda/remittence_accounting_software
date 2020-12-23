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
                'order' => '2',
                'parent_id' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Users',
                'url' => '/users',
                'icon' => 'fas fa-users',
                'roleid' => '1',
                'order' => '1',
                'parent_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Role',
                'url' => '/roles',
                'icon' => 'fas fa-users-cog',
                'roleid' => '1',
                'order' => '2',
                'parent_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Country',
                'url' => '/countries',
                'icon' => 'fas fa-flag-usa',
                'roleid' => '1',
                'order' => '3',
                'parent_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Currency',
                'url' => '/currencies',
                'icon' => 'fas fa-dollar-sign',
                'roleid' => '1',
                'order' => '4',
                'parent_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Exhouse',
                'url' => '/exhouses',
                'icon' => 'fas fa-store',
                'roleid' => '1',
                'order' => '5',
                'parent_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'title' => 'Menu',
                'url' => '/menus',
                'icon' => 'fas fa-stream',
                'roleid' => '1',
                'order' => '5',
                'parent_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],

            // Normal Menu

            // HO Menu

        ]);
    }
}

