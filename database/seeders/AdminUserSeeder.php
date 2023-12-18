<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 既存のデータを削除
        DB::table('admin_users')->truncate();

        // シーダーの内容をここに追加
        AdminUser::factory()->count(2)->create();
    }
}
