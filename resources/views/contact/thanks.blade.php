<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" href="../css/contact-style.css">
</head>

<body>
        <div class="Form">
            <p class="check-in-messege">送信完了しました。</p>
            
            <div class="Form-Item">
                <label class="Form-Item-Label">会社名</label>
                <p>{{ $inputs['company'] }}</p>
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">氏名</label>
                <p>{{ $inputs['name']}}</p>
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">電話番号</label>
                <p>{{ $inputs['tel']}}</p>
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">メールアドレス</label>
                <p>{{ $inputs['email']}}</p>
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">生年月日</label>
                <p>{{ $inputs['birthday']}}</p>
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label">性別</label>
                <p>{{ config('const.gender.' . $inputs['gender']) }}</p>
            </div>
    
            <div class="Form-Item">
                <label class="Form-Item-Label">職業</label>
                <p>{{ config('const.profession.' . $inputs['profession']) }}</p>
            </div>

            <div class="Form-Item">
                <label class="Form-Item-Label isMsg">お問い合わせ内容</label>
                <p>{!! nl2br(e($inputs['body'])) !!}</p>
            </div>

            <a href="{{ route('contact.index') }}"><button type="button" class="Form-Btn">戻る</button></a>

        </div>
</body>


</html>
