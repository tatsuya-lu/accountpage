<!-- adminEdit.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>アカウント編集</title>
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
            <!-- メインのコードを追加 -->
            <p class="admin">管理者 ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <a href="{{ route('admin.logout') }}">
                <p class="logout"><span class="logout-btn">ログアウト</span></p>
            </a>
            <div class="main-aria">
                <p class="page-title">アカウント編集</p>

                <!-- ユーザー情報の表示フォームを追加 -->
                <form method="POST" action="{{ route('admin.table.update', $user->id) }}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <table class="account">
                        <tr>
                            <th>名前</th>
                            <th>メールアドレス</th>
                            <th>新しいパスワード</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="name" class="no-border" value="{{ $user->name }}">
                            </td>
                            <td>
                                <input type="text" name="email" class="no-border" value="{{ $user->email }}">
                            </td>
                            <td>
                                <input type="password" name="password" class="no-border" placeholder="新しいパスワード">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="Form-Btn">更新</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
