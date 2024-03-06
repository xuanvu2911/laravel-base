<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $groupId = DB::table('groups')->insertGetId([
            'name' => 'Administrator',
            'created_by' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if ($groupId > 0) {
            $userid =  DB::table('users')->insertGetId([
                'name' => 'Xuân Vũ',
                'username' => 'admin',
                'email' => 'xuanvu2911@gmail.com',
                'password' => Hash::make('123456'),
                'group_id' => $groupId,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if ($userid > 0) {
                DB::table('menus')->insert([
                    'name' => 'Người dùng',
                    'link' => 'users',
                    'type' => 'link',
                    'created_by' => $userid,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                DB::table('menus')->insert([
                    'name' => 'Nhóm người dùng',
                    'link' => 'groups',
                    'type' => 'link',
                    'created_by' => $userid,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                DB::table('menus')->insert([
                    'name' => 'Menu',
                    'link' => 'menus',
                    'type' => 'link',
                    'created_by' => $userid,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
