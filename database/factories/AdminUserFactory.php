<?php

namespace Database\Factories;

use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Config;

class AdminUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phoneNumber = $this->faker->numerify('###########');
        $phoneNumberWithoutHyphen = str_replace('-', '', $phoneNumber);

        $postCode = $this->faker->numerify('#######');
        $postCodeWithoutHyphen = str_replace('-', '', $postCode);

        $adminLevels = array_keys(Config::get('const.admin_level'));
        $prefectures = array_keys(Config::get('const.prefecture'));

        return [
            'name' => $this->faker->name,
            'sub_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'tel' => $phoneNumberWithoutHyphen,
            'post_code' => $postCodeWithoutHyphen,
            'prefecture' => $this->faker->randomElement(array_keys(Config::get('const.prefecture'))),
            'city' => $this->faker->city,
            'street' => $this->faker->streetAddress,
            'body' => 'これは備考欄です。',
            'admin_level' => $this->faker->randomElement($adminLevels),
        ];
    }
}
