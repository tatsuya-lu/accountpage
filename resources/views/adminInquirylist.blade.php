<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>お問い合わせ一覧</title>
    @extends('layouts.app')
</head>

<body>
    <div class="container">
        @include('layouts.header')

        <main>
            @include('layouts.login')

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
                                <td>{{ config('const.status')[$inquiry->status] ?? $inquiry->status }}</td>
                                <td>{{ $inquiry->company }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->tel }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="pagenation">{{ $inquiries->links() }}</div>
            </div>
        </main>
    </div>
</body>

</html>
