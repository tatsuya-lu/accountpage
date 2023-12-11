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
            'sub_name' => 'required|string|max:255',
            'tel' => 'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/',
            'post_code' => 'required|regex:/^[0-9]{3}[0-9]{4}$/',
            'prefecture' => 'required|in:北海道,青森県,岩手県,宮城県,秋田県,山形県,福島県,茨城県,栃木県,群馬県,埼玉県,千葉県,東京都,神奈川県,新潟県,富山県,石川県,福井県,山梨県,長野県,岐阜県,静岡県,愛知県,三重県,滋賀県,京都府,大阪府,兵庫県,奈良県,和歌山県,鳥取県,島根県,岡山県,広島県,山口県,徳島県,香川県,愛媛県,高知県,福岡県,佐賀県,長崎県,熊本県,大分県,宮崎県,鹿児島県,沖縄県',
            'city' => 'required|string',
            'street' => 'required|string',
            'admin_level' => 'required|in:0,1',
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
            'prefecture' => 'required|in:北海道,青森県,岩手県,宮城県,秋田県,山形県,福島県,茨城県,栃木県,群馬県,埼玉県,千葉県,東京都,神奈川県,新潟県,富山県,石川県,福井県,山梨県,長野県,岐阜県,静岡県,愛知県,三重県,滋賀県,京都府,大阪府,兵庫県,奈良県,和歌山県,鳥取県,島根県,岡山県,広島県,山口県,徳島県,香川県,愛媛県,高知県,福岡県,佐賀県,長崎県,熊本県,大分県,宮崎県,鹿児島県,沖縄県',
            'city' => 'required|string',
            'street' => 'required|string',
            'admin_level' => 'required|in:0,1',
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
