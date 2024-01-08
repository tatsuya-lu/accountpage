@extends('layouts.app')
<title>お問い合わせ編集</title>
@section('content')
        <div class="form-title">
            <p class="page-title">お問い合わせ編集</p>
        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.inquiry.update', $inquiry->id) }}">
            @csrf
            @method('PUT')
            <div class="Form">

                <div class="Inquiry-Item">
                    <label for="status" class="Form-Item-Label sub_title">ステータス</label>
                    <select name="status" id="status" class="Inquiry-Form-Item-Input">
                        @foreach (config('const.status') as $statusKey => $statusLabel)
                            <option value="{{ $statusKey }}" {{ $inquiry->status === $statusKey ? 'selected' : '' }}>
                                {{ $statusLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="Inquiry-Item">
                    <label for="body" class="Form-Item-Label sub_title">お問い合わせ内容</label>
                    <p class="Inquiry-font">{{ $inquiry->body }}</p>
                </div>

                <div class="Inquiry-Item">
                    <label for="comment" class="Form-Item-Label sub_title">備考欄</label>
                    <textarea name="comment" id="comment" class="Inquiry-Form-Item-Textarea">{{ $inquiry->comment }}</textarea>
                </div>

                <div class="Inquiry-Item Inquiry-box">
                    <p class="sub_title">お問い合わせ情報</p>
                </div>

                <div class="Inquiry-Item">
                    <label for="company" class="Form-Item-Label Inquiry-Label">会社名:{{ $inquiry->company }}</label>
                </div>

                <div class="Inquiry-Item">
                    <label for="name" class="Form-Item-Label Inquiry-Label">氏名:{{ $inquiry->name }}</label>
                </div>

                <div class="Inquiry-Item">
                    <label for="tel" class="Form-Item-Label Inquiry-Label">電話番号:{{ $inquiry->tel }}</label>
                </div>

                <div class="Inquiry-Item">
                    <label for="email" class="Form-Item-Label Inquiry-Label">メールアドレス:{{ $inquiry->email }}</label>
                </div>

                <div class="Inquiry-Item">
                    <label for="birthday" class="Form-Item-Label Inquiry-Label">生年月日:{{ $inquiry->birthday }}</label>
                </div>

                <div class="Inquiry-Item">
                    <label for="gender"
                        class="Form-Item-Label Inquiry-Label">性別:{{ config('const.gender.' . $inquiry->gender) }}</label>
                </div>

                <div class="Inquiry-Item">
                    <label for="profession"
                        class="Form-Item-Label Inquiry-Label">職業:{{ config('const.profession.' . $inquiry->profession) }}</label>
                </div>

                <input type="submit" class="Form-Btn" value="更新">
            </div>
        </form>
@endsection
