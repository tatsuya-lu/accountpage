<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ダッシュボード</title>
    @extends('layouts.app')
</head>

<body>
    <div class="container">
        @include('layouts.header')

        <main>
            @include('layouts.login')

            <div class="main-aria">
                <p class="page-title">HOME</p>
                <div class="table-menu">
                    <p><a href="{{ route('admin.table.register.form') }}"><span class="regist">アカウント登録</span></a></p>
                    <p><a href="{{ route('admin.table') }}"><span class="summary">アカウント一覧</span></a></p>
                </div>
            </div>

        </main>
    </div>
</body>

</html>
