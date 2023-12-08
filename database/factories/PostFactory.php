<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phoneNumber = $this->faker->phoneNumber;
        $phoneNumberWithoutHyphen = str_replace('-', '', $phoneNumber);

        return [
            'company' => $this->faker->company,
            'name' => $this->faker->name,
            'tel' => $phoneNumberWithoutHyphen,
            'email' => $this->faker->unique()->safeEmail,
            'birthday' => $this->faker->date,
            'gender' => $this->faker->randomElement(['男', '女']),
            'profession' => $this->faker->randomElement(['公務員', '会社員', 'エンジニア']),
            'body' => 'これはお問い合わせの本文です。',
            'status' => $this->faker->randomElement(['未対応', '対応中', '対応済み']),
            'comment' => 'これは備考欄です。',
        ];
    }
}
