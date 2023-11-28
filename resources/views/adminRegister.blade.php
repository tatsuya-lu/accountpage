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
                <a href="{{ route('admin.dashboard') }}">
                    <p><span class="fa-solid fa-house"></span>HOME</p>
                </a>
                <a href="{{ route('admin.table') }}">
                    <p><span class="fa-solid fa-envelopes-bulk"></span>アカウント一覧</p>
                </a>
                <p><span class="fa-solid fa-envelopes-bulk"></span>お問い合わせ一覧</p>
            </div>

        </header>

        <main>
            <p class="admin">ログイン中：管理者 {{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <p class="logout"><a href="{{ route('admin.logout') }}"><span class="logout-btn">ログアウト</span></a></p>

            <div class="main-aria">
                <p class="page-title">アカウント一覧</p>

                @isset($registered)
                    <div class="success">登録に成功しました。メールアドレス：{{ $registered_email }}</div>
                @endisset
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <div class="Form">

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>会員名</p>
                            <input type="text" id="name" name="name" class="Form-Item-Input" value="{{ old('name') }}"
                                placeholder="例）山田太郎">

                            @if ($errors->has('name'))
                                <p class="error-message">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>フリガナ</p>
                            <input type="text" id="sub_name" name="sub_name" class="Form-Item-Input" value="{{ old('sub_name') }}"
                                placeholder="例）ヤマダタロウ">

                            @if ($errors->has('sub_name'))
                                <p class="error-message">{{ $errors->first('sub_name') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
                            <input type="text" id="email" name="email" class="Form-Item-Input" value="{{ old('email') }}"
                                placeholder="例）example@gmail.com">

                            @if ($errors->has('email'))
                                <p class="error-message">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>パスワード</p>
                            <input type="password" id="password" name="password" class="Form-Item-Input" value="{{ old('password') }}"
                                placeholder="八文字以上で入力してください。">

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
                            <input type="text" id="tel" name="tel" class="Form-Item-Input" value="{{ old('tel') }}"
                                placeholder="例）000 0000 0000   注:ハイフン無しで入力してください">

                            @if ($errors->has('tel'))
                                <p class="error-message">{{ $errors->first('tel') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>郵便番号</p>
                            <input type="text" id="post_code" name="post_code" class="Form-Item-Input" value="{{ old('post_code') }}"
                                placeholder="例）000 0000   注:ハイフン無しで入力してください">

                            @if ($errors->has('post_code'))
                                <p class="error-message">{{ $errors->first('post_code') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>都道府県</p>
                            <select name="prefecture" id="prefecture" class="Form-Item-Input">
                                <option value="" selected disabled>都道府県を選択してください</option>
                                <option value="北海道" @if (old('prefecture') == '北海道') selected @endif>北海道</option>
                                <option value="青森県" @if (old('prefecture') == '青森県') selected @endif>青森県</option>
                                <option value="岩手県" @if (old('prefecture') == '岩手県') selected @endif>岩手県</option>
                                <option value="宮城県" @if (old('prefecture') == '宮城県') selected @endif>宮城県</option>
                                <option value="秋田県" @if (old('prefecture') == '秋田県') selected @endif>秋田県</option>
                                <option value="山形県" @if (old('prefecture') == '山形県') selected @endif>山形県</option>
                                <option value="福島県" @if (old('prefecture') == '福島県') selected @endif>福島県</option>
                                <option value="茨城県" @if (old('prefecture') == '茨城県') selected @endif>茨城県</option>
                                <option value="栃木県" @if (old('prefecture') == '栃木県') selected @endif>栃木県</option>
                                <option value="群馬県" @if (old('prefecture') == '群馬県') selected @endif>群馬県</option>
                                <option value="埼玉県" @if (old('prefecture') == '埼玉県') selected @endif>埼玉県</option>
                                <option value="千葉県" @if (old('prefecture') == '千葉県') selected @endif>千葉県</option>
                                <option value="東京都" @if (old('prefecture') == '東京都') selected @endif>東京都</option>
                                <option value="神奈川県" @if (old('prefecture') == '神奈川県') selected @endif>神奈川県</option>
                                <option value="新潟県" @if (old('prefecture') == '新潟県') selected @endif>新潟県</option>
                                <option value="富山県" @if (old('prefecture') == '富山県') selected @endif>富山県</option>
                                <option value="石川県" @if (old('prefecture') == '石川県') selected @endif>石川県</option>
                                <option value="福井県" @if (old('prefecture') == '福井県') selected @endif>福井県</option>
                                <option value="山梨県" @if (old('prefecture') == '山梨県') selected @endif>山梨県</option>
                                <option value="長野県" @if (old('prefecture') == '長野県') selected @endif>長野県</option>
                                <option value="岐阜県" @if (old('prefecture') == '岐阜県') selected @endif>岐阜県</option>
                                <option value="静岡県" @if (old('prefecture') == '静岡県') selected @endif>静岡県</option>
                                <option value="愛知県" @if (old('prefecture') == '愛知県') selected @endif>愛知県</option>
                                <option value="三重県" @if (old('prefecture') == '三重県') selected @endif>三重県</option>
                                <option value="滋賀県" @if (old('prefecture') == '滋賀県') selected @endif>滋賀県</option>
                                <option value="京都府" @if (old('prefecture') == '京都府') selected @endif>京都府</option>
                                <option value="大阪府" @if (old('prefecture') == '大阪府') selected @endif>大阪府</option>
                                <option value="兵庫県" @if (old('prefecture') == '兵庫県') selected @endif>兵庫県</option>
                                <option value="奈良県" @if (old('prefecture') == '奈良県') selected @endif>奈良県</option>
                                <option value="和歌山県" @if (old('prefecture') == '和歌山県') selected @endif>和歌山県</option>
                                <option value="鳥取県" @if (old('prefecture') == '鳥取県') selected @endif>鳥取県</option>
                                <option value="島根県" @if (old('prefecture') == '島根県') selected @endif>島根県</option>
                                <option value="岡山県" @if (old('prefecture') == '岡山県') selected @endif>岡山県</option>
                                <option value="広島県" @if (old('prefecture') == '広島県') selected @endif>広島県</option>
                                <option value="山口県" @if (old('prefecture') == '山口県') selected @endif>山口県</option>
                                <option value="徳島県" @if (old('prefecture') == '徳島県') selected @endif>徳島県</option>
                                <option value="香川県" @if (old('prefecture') == '香川県') selected @endif>香川県</option>
                                <option value="愛媛県" @if (old('prefecture') == '愛媛県') selected @endif>愛媛県</option>
                                <option value="高知県" @if (old('prefecture') == '高知県') selected @endif>高知県</option>
                                <option value="福岡県" @if (old('prefecture') == '福岡県') selected @endif>福岡県</option>
                                <option value="佐賀県" @if (old('prefecture') == '佐賀県') selected @endif>佐賀県</option>
                                <option value="長崎県" @if (old('prefecture') == '長崎県') selected @endif>長崎県</option>
                                <option value="熊本県" @if (old('prefecture') == '熊本県') selected @endif>熊本県</option>
                                <option value="大分県" @if (old('prefecture') == '大分県') selected @endif>大分県</option>
                                <option value="宮崎県" @if (old('prefecture') == '宮城県') selected @endif>宮崎県</option>
                                <option value="鹿児島県" @if (old('prefecture') == '鹿児島県') selected @endif>鹿児島県</option>
                                <option value="沖縄県" @if (old('prefecture') == '沖縄県') selected @endif>沖縄県</option>
                            </select>

                            @if ($errors->has('prefecture'))
                                <p class="error-message">{{ $errors->first('prefecture') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>市町村</p>
                            <input type="text" id="city" name="city" class="Form-Item-Input" value="{{ old('city') }}"
                                placeholder="">

                            @if ($errors->has('city'))
                                <p class="error-message">{{ $errors->first('city') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>番地・アパート名</p>
                            <input type="text" id="street" name="street" class="Form-Item-Input" value="{{ old('street') }}"
                                placeholder="">

                            @if ($errors->has('street'))
                                <p class="error-message">{{ $errors->first('street') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <label class="Form-Item-Label isMsg">備考欄</label>
                            <textarea class="Form-Item-Textarea" name="body">{{ old('body') }}</textarea>

                            @if ($errors->has('body'))
                                <p class="error-message">{{ $errors->first('body', '') }}</p>
                            @endif
                        </div>

                        <div class="Form-Item">
                            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>AdminLevel</p>
                            <select name="admin_level" id="admin_level" class="Form-Item-Input">
                                <option value="0" selected disabled>権限を選択してください</option>
                                <option value="0" @if (old('admin_level') == '0') selected @endif>社員</option>
                                <option value="1" @if (old('admin_level') == '1') selected @endif>管理者</option>
                            </select>

                            @if ($errors->has('admin_level'))
                                <p class="error-message">{{ $errors->first('admin_level') }}</p>
                            @endif
                        </div>

                        <input type="submit" class="Form-Btn" value="確認する">
                    </div>
                </form>
            </div>

        </main>
    </div>
</body>

</html>
