@extends('layouts.app')
<title>ダッシュボード</title>
@section('content')
        <p class="page-title">HOME</p>
        <div class="table-menu">
            <p><a href="{{ route('admin.table.register.form') }}"><span class="regist">アカウント登録</span></a></p>
            <p><a href="{{ route('admin.table') }}"><span class="summary">アカウント一覧</span></a></p>
        </div>
@endsection
