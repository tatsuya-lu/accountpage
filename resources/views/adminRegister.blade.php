<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>アカウント登録</title>
    @extends('layouts.app')
</head>

<body>
    <div class="container">
        <header>
            <p class="side-button"><span class="fa-solid fa-bars"></span></p>
            <div class="side-menulist">
                <a href="{{ route('admin.dashboard') }}">
                    <p><span class="fa-solid fa-house"></span>HOME</p>
                </a>
                <a href="{{ route('admin.table') }}">
                    <p><span class="fa-solid fa-envelopes-bulk"></span>アカウント一覧</p>
                </a>
                <a href="{{ route('admin.inquiry.index') }}">
                    <p><span class="fa-solid fa-envelopes-bulk"></span>お問い合わせ一覧</p>
                </a>
            </div>

        </header>

        <main>
            <p class="admin">ログイン中：管理者 {{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <p class="logout"><a href="{{ route('admin.logout') }}"><span class="logout-btn">ログアウト</span></a></p>

            <div class="main-aria">
                <p class="page-title">アカウント一覧</p>

                <form method="POST"
                    action="{{ isset($user) ? route('admin.table.update', ['user' => $user->id]) : route('admin.table.register.form') }}">
                    @csrf
                    @if (isset($user))
                        @method('PUT')
                    @endif
                    <div class="Form">

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>会員名</p>
                            <input type="text" id="name" name="name" class="Form-Item-Input"
                                value="{{ old('name', isset($user) ? $user->name : '') }}" placeholder="例）山田太郎">

                            @if ($errors->has('name'))
                                <p class="error-message">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>フリガナ</p>
                            <input type="text" id="sub_name" name="sub_name" class="Form-Item-Input"
                                value="{{ old('sub_name', isset($user) ? $user->sub_name : '') }}"
                                placeholder="例）ヤマダタロウ">

                            @if ($errors->has('sub_name'))
                                <p class="error-message">{{ $errors->first('sub_name') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
                            <input type="text" id="email" name="email" class="Form-Item-Input"
                                value="{{ old('email', isset($user) ? $user->email : '') }}"
                                placeholder="例）example@gmail.com">

                            @if ($errors->has('email'))
                                <p class="error-message">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>パスワード</p>
                            <input type="password" id="password" name="password" class="Form-Item-Input"
                                value="{{ old('password') }}" placeholder="八文字以上で入力してください。">

                            @if ($errors->has('password'))
                                <p class="error-message">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>パスワード(再入力)</p>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="Form-Item-Input" placeholder="パスワードを再入力してください。">

                            @if ($errors->has('password'))
                                <p class="error-message">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>電話番号</p>
                            <input type="text" id="tel" name="tel" class="Form-Item-Input"
                                value="{{ old('tel', isset($user) ? $user->tel : '') }}"
                                placeholder="例）000 0000 0000   注:ハイフン無しで入力してください">

                            @if ($errors->has('tel'))
                                <p class="error-message">{{ $errors->first('tel') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>郵便番号</p>
                            <input type="text" id="post_code" name="post_code" class="Form-Item-Input"
                                value="{{ old('post_code', isset($user) ? $user->post_code : '') }}"
                                placeholder="例）000 0000   注:ハイフン無しで入力してください">

                            @if ($errors->has('post_code'))
                                <p class="error-message">{{ $errors->first('post_code') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>都道府県</p>
                            <select name="prefecture" id="prefecture" class="Form-Item-Input">
                                <option value="" selected disabled>都道府県を選択してください</option>
                                @foreach ($prefectures as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ old('prefecture', isset($user) ? $user->prefecture : '') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('prefecture'))
                                <p class="error-message">{{ $errors->first('prefecture') }}</p>
                            @endif
                        </div>


                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>市町村</p>
                            <input type="text" id="city" name="city" class="Form-Item-Input"
                                value="{{ old('city', isset($user) ? $user->city : '') }}" placeholder="">

                            @if ($errors->has('city'))
                                <p class="error-message">{{ $errors->first('city') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>番地・アパート名</p>
                            <input type="text" id="street" name="street" class="Form-Item-Input"
                                value="{{ old('street', isset($user) ? $user->street : '') }}" placeholder="">

                            @if ($errors->has('street'))
                                <p class="error-message">{{ $errors->first('street') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <label class="Form-Item-Label isMsg">備考欄</label>
                            <textarea class="Form-Item-Textarea" name="body">{{ old('body', isset($user) ? $user->body : '') }}</textarea>

                            @if ($errors->has('body'))
                                <p class="error-message">{{ $errors->first('body', '') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>アカウントの種類</p>
                            <select name="admin_level" id="admin_level" class="Form-Item-Input">
                                <option value="" selected disabled>アカウントの種類を選択してください</option>
                                @foreach ($adminLevels as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ old('admin_level', isset($user) ? $user->admin_level : '') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('admin_level'))
                                <p class="error-message">{{ $errors->first('admin_level') }}</p>
                            @endif
                        </div>

                        <input type="submit" class="Form-Btn" value="{{ isset($user) ? '更新する' : '確認する' }}">
                    </div>
                </form>
            </div>

        </main>
    </div>
</body>

</html>
