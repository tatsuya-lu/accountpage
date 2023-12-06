<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>お問い合わせ一覧</title>
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
                    <p class="page-title">お問い合わせ一覧</p>
                </div>

                @if (session('success'))
                    <div class="success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table">
                    <table class="account">
                        <tr>
                            <th>編集</th>
                            {{-- <th>削除</th> --}}
                            <th>ステータス</th>
                            <th>会社名</th>
                            <th>氏名</th>
                            <th>電話番号</th>
                        </tr>
                        @foreach ($inquiries as $inquiry)
                            <tr>
                                <td class="table-center">
                                    <a href="{{ route('admin.inquiry.edit', $inquiry->id) }}">
                                        <span class="fa-solid fa-pen-to-square"></span>
                                    </a>
                                </td>
                                {{-- <td class="table-center">
                                    <form method="POST" action="{{ route('admin.inquiry.destroy', $inquiry->id) }}"
                                        onsubmit="return confirm('削除します。よろしいですか？')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="no-border">
                                            <span class="fa-solid fa-trash-can"></span>
                                        </button>
                                    </form>
                                </td> --}}
                                <td>{{ $inquiry->status }}</td>
                                <td>{{ $inquiry->company }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->tel }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
