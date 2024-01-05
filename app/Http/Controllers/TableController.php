<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Models\AdminUser;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TableRequest;
use Config;


class TableController extends Controller
{

    use RegistersUsers;

    protected $prefectures;
    protected $adminLevels;

    public function __construct()
    {
        $this->prefectures = config('const.prefecture');
        $this->adminLevels = config('const.admin_level');

        view()->share(['prefectures' => $this->prefectures, 'adminLevels' => $this->adminLevels]);
    }

    public function adminRegisterForm(Request $request)
    {
        $user = new AdminUser;
        $prefectures = $this->prefectures;
        $adminLevels = $this->adminLevels;

        return view('adminRegister', compact('user','prefectures', 'adminLevels'));
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
            'prefecture' => $data['prefecture'],
            'city' => $data['city'],
            'street' => $data['street'],
            'body' => $data['body'] !== null ? $data['body'] : '',
            'admin_level' => intval($data['admin_level']),
        ]);

        if ($user) {
            session()->flash('registered_message', 'アカウントが正常に登録されました。');
        }

        return $user;
    }

    public function adminRegister(TableRequest $request)
    {
        $user = $this->adminRegisterDatabase($request->all());

        if ($user) {
            session()->flash('registered_message', 'アカウントが正常に登録されました。');
            session()->flash('registered_email', $user->email);
            return redirect()->route('admin.table');
        } else {
            return redirect()->route('admin.table')->with('error', 'ユーザーの登録に失敗しました。');
        }
    }

    public function adminTable()
    {
        $users = AdminUser::all();

        return view('adminTable', compact('users'));
    }

    public function update(TableRequest $request, AdminUser $user)
    {

        // ユーザー情報の更新
        $user->name = $request->name;
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->prefecture = $request->prefecture;
        $user->post_code = $request->post_code;
        $user->city = $request->city;
        $user->street = $request->street;
        $user->body = $request->body;
        $user->admin_level = $request->admin_level;


        if ($request->filled('password')) {
            // パスワードのハッシュ化
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.table')->with('success', 'ユーザーが正常に更新されました。');
    }

    public function edit(AdminUser $user)
    {
        $prefectures = $this->prefectures;
        $adminLevels = $this->adminLevels;

        return view('adminRegister', compact('user', 'prefectures', 'adminLevels'));
    }

    public function destroy(AdminUser $user)
    {

        // ユーザー削除
        $user->delete();

        // 削除後にリダイレクト
        return redirect()->route('admin.table')->with('success', 'ユーザーが正常に削除されました。');
    }
}
