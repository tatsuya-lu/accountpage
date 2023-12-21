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
        $this->prefectures = array_keys(Config::get('const.prefecture'));
        $this->adminLevels = array_keys(Config::get('const.admin_level'));
    }

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
            'tel' => ['required', 'regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/'],
            'post_code' => ['required', 'regex:/^[0-9]{3}[0-9]{4}$/'],
            'prefecture' => ['required', 'in:' . implode(',', $this->prefectures)],
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
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
        return view('adminTable', ['users' => $users]);
    }

    public function store(TableRequest $request)
    {

        // フォームからのリクエストを取得
        $requestData = $request->all();

        // 都道府県が選択されている場合のみ変換
        if (isset($requestData['prefecture'])) {
            $requestData['prefecture'] = array_search($requestData['prefecture'], Config::get('const.prefecture'));
        }

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
