<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>登録</title>
    @extends('layouts.app')
</head>

<body>
    <div class="container">
        <header>
            <p class="side-button"><span class="fa-solid fa-bars"></span></p>
            <div class="side-menulist">
                <a href="{{ route('admin.dashboard')}}"><p><span class="fa-solid fa-house"></span>HOME</p></a>
                <p><span class="fa-solid fa-envelopes-bulk"></span>アカウント一覧</p>
                <p><span class="fa-solid fa-envelopes-bulk"></span>お問い合わせ一覧</p>
            </div>

        </header>

        <main>
            <p class="admin">管理者 ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <div class="main-aria">
                <p class="page-title">アカウント一覧</p>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif

                @isset($registered)
                    <div>登録に成功しました。メールアドレス：{{ $registered_email }}</div>
                @endisset
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <div class="Form">

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>会員名</p>
                            <input type="text" id="name" name="name" class="Form-Item-Input" placeholder="例）山田太郎">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>フリガナ</p>
                            <input type="text" id="sub_name" name="sub_name" class="Form-Item-Input" placeholder="例）ヤマダタロウ">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
                            <input type="text" id="email" name="email" class="Form-Item-Input" placeholder="例）example@gmail.com">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>パスワード</p>
                            <input type="password" id="password" name="password" class="Form-Item-Input" placeholder="例）">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>パスワード(再入力)</p>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="Form-Item-Input" placeholder="例）">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>電話番号</p>
                            <input type="text" id="tel" name="tel" class="Form-Item-Input" placeholder="例）000-0000-0000">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>郵便番号</p>
                            <input type="text" id="post_code" name="post_code" class="Form-Item-Input" placeholder="例）000-0000">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>都道府県</p>
                            <input type="text" id="prefecture" name="prefecture" class="Form-Item-Input" placeholder="例）">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>市町村</p>
                            <input type="text" id="city" name="city" class="Form-Item-Input" placeholder="例）">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>番地・アパート名</p>
                            <input type="text" id="street" name="street" class="Form-Item-Input" placeholder="例）">
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>AdminLevel</p>
                            <input type="text" id="admin_level" name="admin_level" class="Form-Item-Input" placeholder="例）「0」か「1」を入力">
                        </div>

                        <input type="submit" class="Form-Btn" value="確認する">
                    </div>
                </form>
            </div>

        </main>
    </div>
</body>
</html>
