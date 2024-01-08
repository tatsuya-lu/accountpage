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