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
            'tel' => ['required','regex:/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/'],
            'post_code' => ['required','regex:/^[0-9]{3}-[0-9]{4}$/'],
            'prefecture'=> ['required','string'],
            'city'=> ['required','string'],
            'street'=> ['required','string'],
            'admin_level' => ['required', 'numeric'],
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
