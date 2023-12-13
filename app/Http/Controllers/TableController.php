<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Http\FormRequest;
use Config;

class TableController extends Controller
{

    public function adminTable()
    {
        $users = AdminUser::all();
        return view('adminTable', ['users' => $users]);
    }

    public function __construct()
    {
        $this->prefectures = array_keys(Config::get('const.prefecture'));
        $this->adminLevels = array_keys(Config::get('const.admin_level'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_users|max:255',
            'password' => 'required|string|min:8',
            'sub_name' => 'required|string|max:255',
            'tel' => 'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/',
            'post_code' => 'required|regex:/^[0-9]{3}[0-9]{4}$/',
            'prefecture' => 'required|in:' . implode(',', array_keys(config('const.prefecture'))),
            'city' => 'required|string',
            'street' => 'required|string',
            'admin_level' => 'required|in:' . implode(',', array_keys(config('const.admin_level'))),
        ]);

        // パスワードのハッシュ化
        $hashedPassword = bcrypt($request->password);

        // ユーザーの作成
        $user = AdminUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'sub_name' => $request->sub_name,
            'tel' => $request->tel,
            'post_code' => $request->post_code,
            'prefecture' => $request->prefecture,
            'city' => $request->city,
            'street' => $request->street,
            'admin_level' => $request->admin_level,
        ]);

        return ['result' => true];
    }

    public function update(Request $request, AdminUser $user)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('admin_users')->ignore($user->id),
                'max:255',
            ],
            'password' => 'nullable|string|min:8',
            'sub_name' => 'required|string|max:255',
            'tel' => 'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/',
            'post_code' => 'required|regex:/^[0-9]{3}[0-9]{4}$/',
            'prefecture' => 'required|in:' . implode(',', array_keys(config('const.prefecture'))),
            'city' => 'required|string',
            'street' => 'required|string',
            'admin_level' => 'required|in:' . implode(',', array_keys(config('const.admin_level'))),
        ]);

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
        return View::make('adminRegister', compact('user'));
    }

    public function destroy(AdminUser $user)
    {

        // ユーザー削除
        $user->delete();

        // 削除後にリダイレクト
        return redirect()->route('admin.table')->with('success', 'ユーザーが正常に削除されました。');
    }
}
