<!DOCTYPE html>
<html lang="ja">

<head>
    @extends('layouts.app')

</head>

<body>

    <p>お問い合わせ内容を受け付けました。</p><br>

    <p>■会社名</p>
    {!! $company !!}

    <p>■氏名</p>
    {!! $name !!}

    <p>■電話番号</p>
    {!! $tel !!}

    <p>■メールアドレス</p>
    {!! $email !!}

    <p>■生年月日</p>
    {!! $birthday !!}

    <p>■性別</p>
    {!! $gender !!}

    <p>■職業</p>
    {!! $profession !!}

    <p>■お問い合わせ内容</p>
    {!! nl2br(e($body)) !!}

</body>

</html>
