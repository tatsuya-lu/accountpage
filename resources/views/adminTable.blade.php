<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>アカウント一覧</title>
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
            <p class="admin">管理者 ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <p class="logout"><a href="{{ route('admin.logout') }}"><span class="logout-btn">ログアウト</span></a></p>

            <div class="main-aria">
                <div class="table-title">
                    <p class="page-title">アカウント一覧</p>
                    <a href="{{ route('admin.table.register.form') }}">
                        <p class="regist-btn"><span class="fa-solid fa-circle-plus"></span>新規作成</p>
                    </a>
                </div>


                @if (session('registered_message'))
                    <div class="success">
                        {{ session('registered_message') }} {{ session('registered_email') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table">
                    <table class="account">
                        <tr>
                            <th>編集</th>
                            <th>削除</th>
                            <th>名前</th>
                            <th>アカウントの種類</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>都道府県</th>
                            <th>市町村</th>
                            <th>番地・アパート名</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td class="table-center">
                                    <a href="{{ route('admin.table.edit', $user->id) }}">
                                        <span class="fa-solid fa-pen-to-square"></span>
                                    </a>
                                </td>
                                <td class="table-center">
                                    <form method="POST" action="{{ route('admin.table.destroy', $user->id) }}"
                                        onsubmit="return confirm('削除します。よろしいですか？')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="no-border">
                                            <span class="fa-solid fa-trash-can"></span>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if ($user->admin_level == 0)
                                        社員
                                    @elseif ($user->admin_level == 1)
                                        管理者
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->tel ?? 'undefined' }}</td>
                                <td>{{ config('const.prefecture.' . $user->prefecture) ?? 'undefined' }}</td>
                                <td>{{ $user->city ?? 'undefined' }}</td>
                                <td>{{ $user->street ?? 'undefined' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
