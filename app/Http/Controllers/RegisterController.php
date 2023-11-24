<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminUser;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function adminRegisterForm(Request $request)
    {
        return view('adminRegister');
    }

    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'sub_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\AdminUser'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'tel' => ['required','regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/'],
            'post_code' => ['required','regex:/^[0-9]{3}[0-9]{4}$/'],
            'prefecture'=> ['required','in:北海道,青森県,岩手県,宮城県,秋田県,山形県,福島県,茨城県,栃木県,群馬県,埼玉県,千葉県,東京都,神奈川県,新潟県,富山県,石川県,福井県,山梨県,長野県,岐阜県,静岡県,愛知県,三重県,滋賀県,京都府,大阪府,兵庫県,奈良県,和歌山県,鳥取県,島根県,岡山県,広島県,山口県,徳島県,香川県,愛媛県,高知県,福岡県,佐賀県,長崎県,熊本県,大分県,宮崎県,鹿児島県,沖縄県'],
            'city'=> ['required','string'],
            'street'=> ['required','string'],
            'admin_level' => ['required', 'in:0,1'],
        ]);
    }

    protected function adminRegisterDatabase(array $data)
    {
        return AdminUser::create([
            'name' => $data['name'],
            'sub_name' => $data['sub_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tel' => $data['tel'],
            'post_code' => $data['post_code'],
            'prefecture'=> $data['prefecture'],
            'city'=> $data['city'],
            'street'=> $data['street'],
            'admin_level' => $data['admin_level'],
        ]);
    }

    public function adminRegister(Request $request)
    {
        $this->adminValidator($request->all())->validate();

        $user = $this->adminRegisterDatabase($request->all());

        if ($user) {
            return view('adminRegister', ['registered' => true, 'registered_email' => $user->email]);
        }
    }
}
