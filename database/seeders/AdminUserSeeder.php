<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // ←これを追加

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'name' => 'owner',
            'sub_name' => 'オーナー',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'tel' => '00000000000',
            'post_code' => '0000000',
            'prefecture'=> '大阪府',
            'city'=> '大阪市',
            'street'=> '中央区',
            'body'=> 'テスト用権限有りアカウント',
            'admin_level' => 1,
        ]);
        DB::table('admin_users')->insert([
            'name' => 'sub',
            'sub_name' => 'オーナー',
            'email' => 'sub@example.com',
            'password' => Hash::make('password'),
            'tel' => '00000000000',
            'post_code' => '0000000',
            'prefecture'=> '大阪府',
            'city'=> '大阪市',
            'street'=> '中央区',
            'body'=> 'テスト用権限無しアカウント',
            'admin_level' => 0,
        ]);
    }
}
