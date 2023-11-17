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
                <p><span class="fa-solid fa-envelopes-bulk"></span>アカウント一覧</p>
                <p><span class="fa-solid fa-envelopes-bulk"></span>お問い合わせ一覧</p>
            </div>

        </header>

        <main>
            <p class="admin">管理者 ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <a href="{{ route('admin.logout') }}">
                <p>ログアウト</p>
            </a>
            <div class="main-aria">
                <p class="page-title">アカウント一覧</p>
                <div class="table">
                    <table>
                        <tr>
                            <th>編集</th>
                            <th>削除</th>
                            <th>名前</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>都道府県</th>
                            <th>市町村</th>
                            <th>番地・アパート名</th>
                        </tr>
                        <tr>
                            <td><span class="fa-solid fa-pen-to-square"></span></td>
                            <td><span class="fa-solid fa-trash-can"></span></td>
                            <td>{{ Auth::guard('admin')->user()->name ?? 'undefined' }}</td>
                            <td>{{ Auth::guard('admin')->user()->email ?? 'undefined' }}</td>
                            <td>{{ Auth::guard('admin')->user()->tel ?? 'undefined' }}</td>
                            <td>{{ Auth::guard('admin')->user()->prefecture ?? 'undefined' }}</td>
                            <td>{{ Auth::guard('admin')->user()->city ?? 'undefined' }}</td>
                            <td>{{ Auth::guard('admin')->user()->street ?? 'undefined' }}</td>
                        </tr> 
                    </table>
                </div>
            </div>

        </main>
    </div>
</body>

</html>