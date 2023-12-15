<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Config;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 既存のデータを削除
        DB::table('posts')->truncate();

        // シーダーの内容をここに追加
        \App\Models\Post::factory()->count(15)->create([
            'gender' => function () {
                $faker = \Faker\Factory::create();
                return $faker->randomElement(array_values(Config::get('const.gender')));
            },
            'profession' => function () {
                $faker = \Faker\Factory::create();
                return $faker->randomElement(array_values(Config::get('const.profession')));
            },
            'status' => function () {
                $faker = \Faker\Factory::create();
                return $faker->randomElement(array_values(Config::get('const.status')));
            },
        ]);
    }
}

