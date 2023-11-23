<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ダッシュボード</title>
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
            <p class="admin">管理者 ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}</p>
            <a href="{{ route('admin.logout') }}">
                <p class="logout-btn">ログアウト</p>
            </a>
            <div class="main-aria">
                <p class="page-title">アカウント一覧</p>
                <div class="table">
                    <table class="account">
                        <tr>
                            <th>編集</th>
                            <th>削除</th>
                            <th>名前</th>
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
                                    <form method="POST" action="{{ route('admin.table.destroy', $user->id) }}" onsubmit="return confirm('削除します。よろしいですか？')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="no-border">
                                            <span class="fa-solid fa-trash-can"></span>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->tel ?? 'undefined' }}</td>
                                <td>{{ $user->prefecture ?? 'undefined' }}</td>
                                <td>{{ $user->city ?? 'undefined' }}</td>
                                <td>{{ $user->street ?? 'undefined' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </main>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                state: 'admin.table',
                params: {
                    id: -1,
                    name: '',
                    email: '',
                    password: '',
                    passwordConfirmation: ''
                },
                users: @json($users)
            },
            methods: {
                changeState(state, value) {
                    if (state === 'create') {
                        this.params = {
                            id: -1,
                            name: '',
                            email: '',
                            password: '',
                            passwordConfirmation: ''
                        };
                    } else if (state === 'edit') {
                        // 修正: this.$set を使用してオブジェクトのプロパティを更新
                        this.$set(this, 'params', value);
                    }
                    this.$set(this.params, 'state', state); // 修正: state の変更
                },
                onEdit(user) {
                    // 修正: this.$set を使用してオブジェクトのプロパティを更新
                    this.$set(this, 'params', {
                        ...user,
                        state: 'edit'
                    });
                },

                onSave() {
                    const params = this.params;
                    let url = '/admin/table/' + this.params.id;
                    let method = 'PUT';

                    axios({
                            url,
                            method,
                            data: params
                        })
                        .then(response => {
                            if (response.data.result === true) {
                                location.reload();
                            }
                        });
                },
                onDelete(user) {
                    if (confirm('削除します。よろしいですか？')) {
                        const url = '/admin/table/' + user.id;

                        axios.delete(url)
                            .then(response => {
                                if (response.data.result === true) {
                                    location.reload();
                                }
                            });
                    }
                },
            }
        });
    </script> --}}
</body>

</html>
