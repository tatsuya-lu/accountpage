<!DOCTYPE html>
<html lang="ja">

<head>
    {{-- @extends('layouts.app') --}}
    <link rel="stylesheet" href="css/contact-style.css">
</head>

<body>

    {{-- @section('contact') --}}
    <div class="Form">
        <form method="POST" action="{{ route('contact.confirm') }}">
            @csrf

            <div class="Form-Item">
                <label class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>会社名</label>
                <input class="Form-Item-Input" type="text" name="company" maxlength="20" value="{{ old('company') }}"
                    placeholder="例）株式会社令和">

                @if ($errors->has('company'))
                    <p class="error-message">{{ $errors->first('company') }}</p>
                @endif
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>氏名</label>
                <input class="Form-Item-Input" type="text" name="name" maxlength="20" value="{{ old('name') }}"
                    placeholder="例）山田太郎">

                @if ($errors->has('name'))
                    <p class="error-message">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>電話番号</label>
                <input class="Form-Item-Input" type="tel" name="tel" value="{{ old('tel') }}"
                    placeholder="例）000-0000-0000">

                @if ($errors->has('tel'))
                    <p class="error-message">{{ $errors->first('tel') }}</p>
                @endif
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</label>
                <input class="Form-Item-Input" type="email" name="email" value="{{ old('email') }}"
                    placeholder="例）example@gmail.com">

                @if ($errors->has('email'))
                    <p class="error-message">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>生年月日</label>
                <input class="Form-Item-Input" type="date" name="birthday" value="{{ old('birthday') }}">

                @if ($errors->has('birthday'))
                    <p class="error-message">{{ $errors->first('birthday') }}</p>
                @endif
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>性別</label>
                <div class="Form-Item-check">
                    <input type="radio" name="gender" value="男" {{ old('gender') == '男' ? 'checked' : '' }}>
                    <label for="male">男</label>

                    <input type="radio" name="gender" value="女" {{ old('gender') == '女' ? 'checked' : '' }}>
                    <label for="female">女</label>
                </div>

                @if ($errors->has('gender'))
                    <p class="error-message">{{ $errors->first('gender') }}</p>
                @endif
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>職業</label>
                <select name="profession" value="{{ old('profession') }}" class="Form-Item-Input">
                    <option value="">職業を選択してください</option>
                    <option value="公務員" @if (old('profession') == '公務員') selected @endif>公務員</option>
                    <option value="会社員" @if (old('profession') == '会社員') selected @endif>会社員</option>
                    <option value="エンジニア" @if (old('profession') == 'エンジニア') selected @endif>エンジニア</option>
                </select>

                @if ($errors->has('profession'))
                    <p class="error-message">{{ $errors->first('profession') }}</p>
                @endif
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>お問い合わせ内容</label>
                <textarea class="Form-Item-Textarea" name="body">{{ old('body') }}</textarea>

                @if ($errors->has('body'))
                    <p class="error-message">{{ $errors->first('body') }}</p>
                @endif
            </div>

            <button type="submit" class="Form-Btn" value="確認する">確認する</button>
        </form>
    </div>
    {{-- @endsection --}}
</body>

</html>
