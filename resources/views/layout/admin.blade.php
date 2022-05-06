<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" rel="stylesheet">
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>    
    </body>
</html>