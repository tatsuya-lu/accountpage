<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminUser;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

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
            'prefecture'=> ['required', 'in:' . implode(',', $this->prefectures)],
            'city'=> ['required','string'],
            'street'=> ['required','string'],
            'admin_level' => ['required', 'in:' . implode(',', $this->adminLevels)],
        ]);
    }

    protected function adminRegisterDatabase(array $data)
    {
        $user = AdminUser::create([
            'name' => $data['name'],
            'sub_name' => $data['sub_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tel' => $data['tel'],
            'post_code' => $data['post_code'],
            'prefecture'=> $data['prefecture'],
            'city'=> $data['city'],
            'street'=> $data['street'],
            'body' => $data['body'] !== null ? $data['body'] : '',
            'admin_level' => intval($data['admin_level']),
        ]);

        if ($user) {
            session()->flash('registered_message', 'アカウントが正常に登録されました。');
        }
    
        return $user;
    }

    public function adminRegister(RegisterRequest $request)
    {

        $user = $this->adminRegisterDatabase($request->all());
    
        if ($user) {
            session()->flash('registered_message', 'アカウントが正常に登録されました。');
            session()->flash('registered_email', $user->email); 
            return redirect()->route('admin.table'); 
        }
    }
}
