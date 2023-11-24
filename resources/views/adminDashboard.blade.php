<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ダッシュボード</title>
    @extends('layouts.app')
</head>

<body>
    <div class="container">
        <header>
            <p class="side-button"><span class="fa-solid fa-bars"></span></p>
            <div class="side-menulist">
                <a href="{{ route('admin.dashboard')}}"><p><span class="fa-solid fa-house"></span>HOME</p></a>
                <a href="{{ route('admin.table')}}"><p><span class="fa-solid fa-envelopes-bulk"></span>アカウント一覧</p></a>
                <p><span class="fa-solid fa-envelopes-bulk"></span>お問い合わせ一覧</p>
            </div>

        </header>

        <main>
            <p class="admin">ログイン中：管理者 {{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <a href="{{ route('admin.logout') }}">
                <p class="logout"><span class="logout-btn">ログアウト</span></p>
            </a>
            <div class="main-aria">
                <p class="page-title">HOME</p>
                <div class="table-menu">
                    <a href="{{ route('admin.register') }}">
                        <p><span class="regist">アカウント登録</span></p>
                    </a>
                    <a href="{{ route('admin.table')}}"><p><span class="summary">アカウント一覧</span></p></a>
                </div>
            </div>

        </main>
    </div>
</body>

</html>
