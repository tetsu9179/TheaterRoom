<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>TheaterRoomにログイン</title>
    </head>
    <body>
        @if(isset($flash_message))
            <span class="error">{{ $flash_message }}</span>
        @endif
        <div class="friendAdd">
            <form action="{{ Route('password_reset.email.send') }}" method="post">
                @csrf
                <input type="email" name="email" placeholder="メールアドレス">
                <input type="submit" value="送信">
            </form>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/loading.js') }}"></script>
</html>
