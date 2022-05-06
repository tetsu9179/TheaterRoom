<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>TheaterRoomにログイン</title>
    </head>
    <body>
        <div class="loginContainer">
            <div class="login">
                <h1 class="title">新しいパスワードを設定</h1>
                <form method="POST" action="{{ Route('password_reset.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user }}">
                    <div class="input-group">
                        @if($errors->has('password'))
                            @foreach($errors->get('password') as $message)
                                <span class="error">{{ $message }}</div>
                            @endforeach
                        @endif
                        <label for="password" class="label">パスワード</label>
                        <input type="password" name="password">
                        @if($errors->has('password_confimation'))
                            @foreach($errors->get('password_confimation') as $message)
                                <span class="error">{{ $message }}</div>
                            @endforeach
                        @enderror
                    </div>
                    <div class="input-group">
                        <label for="password_confirmation" class="label">パスワードを再入力</label>
                        <input type="password" name="password_confirmation">
                    </div>
                    <button type="submit">パスワードを再設定</button>
                </form>
            </div>
        </div>
    </body>
</html>