<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>TheaterRoomにログイン</title>
    </head>
    <body>
        <div id="logo">
        </div>
        <div class="loginContainer">
            <div class="login">
                <h1>TheaterRoom</h1>
                <form action="/login" method="post" class="loginForm">
                    @csrf
                    @if(session('message'))
                        <span class="error">{{ session('message') }}</span>
                    @endif
                    <input type="text" name="loginId" placeholder="メールアドレス、電話番号">
                    <input type="password" name="password" placeholder="パスワード">
                    <button class="submitArea">
                        <span>ログイン</span>
                    </button>
                    <button type="button" class="submitArea subButton" onclick="location.href='/register'">
                        <span>アカウントを作成</span>
                    </button>
                </form>
                <a href="{{ Route('password_reset.email.form') }}">パスワードを忘れた場合</a>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/loading.js') }}"></script>
</html>
