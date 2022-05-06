<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" rel="stylesheet">
        <!--script-->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>{{ $room->name }}</title>
    </head>
    <body>
        <head>
            </head>
            <main class="chatRoom">
                <div class='sp-chatMenu'>
                    <p><a href=/home class="return"><i class="fa-solid fa-angles-left"></i>{{ $room->name }}</a></p>
                </div>  
                @yield('images')
                <div class='chatArea'>
                    <div class='chatMenu'>
                        <p><a href=/home class="return"><i class="fa-solid fa-angles-left"></i>{{ $room->name }}</a></p>
                    </div>    
                    <div id="chatData"></div>
                    <div class="sendMessege">
                        <form action="/send" method="post" id="addMessage">
                            @csrf
                            <input type="hidden" value="{{ $room->id }}" name="room">
                            <textarea name="chat"></textarea>
                            <input type="submit" value="送信">
                        </form>
                    </div>
                </div>
            </main>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>
</html>