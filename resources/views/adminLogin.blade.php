<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @extends('layouts.app')
    <title>ログイン</title>
</head>

<body>
        <div class="login-container">
            @if ($errors->any()) {{--  エラーがあれば出力する --}}
                @foreach ($errors->all() as $error)
                    <div class="error-message">{{ $error }}</div>
                @endforeach
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <label for="email">Mail</label>
                <input type="text" id="email" name="email">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <button type="submit">Login</button>
            </form>
        </div>
</body>

</html>
