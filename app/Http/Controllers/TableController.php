<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class TableController extends Controller
{

    public function adminTable()
    {
        $users = AdminUser::all();
        return view('adminTable', ['users' => $users]);
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_users|max:255',
            'password' => 'required|string|min:8',
            // 他のフィールドに対するバリデーションを追加
        ]);

        // パスワードのハッシュ化
        $hashedPassword = bcrypt($request->password);

        // ユーザーの作成
        $user = AdminUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            // 他のフィールドを追加
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
            // 他のフィールドに対するバリデーションを追加
        ]);

        // ユーザー情報の更新
        $user->name = $request->name;
        $user->email = $request->email;

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
       // ユーザー削除前にログアウトする
    // auth('admin')->logout();

    // ユーザー削除
    $user->delete();

    // 削除後にリダイレクト
    return redirect()->route('admin.table')->with('success', 'ユーザーが正常に削除されました。');
    }
}
