<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactsSendmail;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ContactRequest;
use Config;


class ContactsController extends Controller
{
    public function index()
    {
        $genders = Config::get('const.gender');
        $professions = Config::get('const.profession');

        return view('contact.index', compact('genders', 'professions'));
    }

    public function confirm(ContactRequest $request)
    {

        $validatedData = $request->validated();
        $genders = config('const.gender');
        $professions = config('const.profession');

        return view('contact.confirm', [
            'inputs' => $validatedData,
            'genders' => $genders,
            'professions' => $professions,
        ]);
    }

    public function send(ContactRequest $request)
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

            // ここで genders と professions を再度取得してビューに渡す
            $genders = config('const.gender');
            $professions = config('const.profession');

            //送信完了ページのviewを表示
            return view('contact.thanks', [
                'inputs' => $inputs,
                'genders' => $genders,
                'professions' => $professions,
            ]);
        }
    }
}
