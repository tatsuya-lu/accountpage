<p class="admin">ログイン中：管理者 {{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
<p class="logout"><a href="{{ route('admin.logout') }}"><span class="logout-btn">ログアウト</span></a></p>
