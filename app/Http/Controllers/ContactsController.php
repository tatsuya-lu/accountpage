<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactsSendmail;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ContactRequest;


class ContactsController extends Controller
{
    public function index()
    {
        //入力ページを表示
        return view('contact.index');
    }

    public function __construct()
    {
        $this->genderes = array_keys(Config::get('const.gender'));
        $this->professions = array_keys(Config::get('const.profession'));
    }

    public function confirm(Request $request)
    {
        //フォームからの入力値をすべて取得
        $inputs = $request->all();

        //確認ページに表示
        //入力値を因数に渡す
        return view('contact.confirm', [
            'inputs' => $inputs,
        ]);
    }

    public function send(Request $request)
    {
        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');

        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if ($action !== 'submit') {
            return redirect()
                ->route('contact.index')
                ->withInput($inputs);
        } else {
            // //入力されたメールアドレスにメールを送信
            // \Mail::to($inputs['email'])->send(new ContactsSendmail($inputs));

            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();

            $post = Post::create([
                'company' => $request->company,
                'name' => $request->name,
                'tel' => $request->tel,
                'email' => $request->email,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'profession' => $request->profession,
                'body' => $request->body
            ]);

            //送信完了ページのviewを表示
            return view('contact.thanks', [
                'inputs' => $inputs,
            ]);
        }
    }
}
