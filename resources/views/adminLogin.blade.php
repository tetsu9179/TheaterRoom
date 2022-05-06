<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>TheaterRoom 管理者ログイン</title>
    </head>
    <body>
        <div class="loginContainer">
            <div class="login">
                <h1>TheaterRoom</h1>
                <form action="/admin" method="post" class="loginForm">
                    @csrf
                    @if(session('message'))
                        <span class="error">{{ session('message') }}</span>
                    @endif
                    
                    <input type="password" name="password" placeholder="パスワード">
                    <button class="submitArea">
                        <span>ログイン</span>
                    </button>
                    <button type="button" class="submitArea subButton" onclick="location.href='/home'">
                        <span>ホームに戻る</span>
                    </button>
                </form>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/loading.js') }}"></script>
</html>