<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use App\Http\Requests\TableRequest;

class TableController extends Controller
{

    public function adminTable()
    {
        $users = AdminUser::all();
        return view('adminTable', ['users' => $users]);
    }

    public function store(TableRequest $request)
    {

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
