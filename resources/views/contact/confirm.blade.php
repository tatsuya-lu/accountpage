<!DOCTYPE html>
<html lang="ja">

<head>
    @extends('layouts.app')

</head>

@section('contact')
    <div class="Form">

        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div class="Form-Item">
                <label class="Form-Item-Label">会社名</label>
                {{ $inputs['company'] }}
                <input class="Form-Item-Input" name="company" value="{{ $inputs['company'] }}" type="hidden">
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">氏名</label>
                {{ $inputs['name'] }}
                <input class="Form-Item-Input" name="name" value="{{ $inputs['name'] }}" type="hidden">
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">電話番号</label>
                {{ $inputs['tel'] }}
                <input class="Form-Item-Input" name="tel" value="{{ $inputs['tel'] }}" type="hidden">
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">メールアドレス</label>
                {{ $inputs['email'] }}
                <input class="Form-Item-Input" name="email" value="{{ $inputs['email'] }}" type="hidden">
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">生年月日</label>
                {{ $inputs['birthday'] }}
                <input class="Form-Item-Input" name="birthday" value="{{ $inputs['birthday'] }}" type="hidden">
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">性別</label>
                {{ $inputs['gender'] }}
                <input class="Form-Item-Input" name="gender" value="{{ $inputs['gender'] }}" type="hidden">
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">職業</label>
                {{ $inputs['profession'] }}
                <input class="Form-Item-Input" name="profession" value="{{ $inputs['profession'] }}" type="hidden">
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label isMsg">お問い合わせ内容</label>
                {!! nl2br(e($inputs['body'])) !!}
                <input class="Form-Item-Input" name="body" value="{{ $inputs['body'] }}" type="hidden">
            </div>


            <button type="submit" class="Form-Btn" name="action" value="back">入力内容修正</button>
            <button type="submit" class="Form-Btn" name="action" value="submit">送信する</button>

    </div>
    </form>
@endsection

</html>
