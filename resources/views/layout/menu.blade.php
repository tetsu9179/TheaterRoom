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
        <div class=container>
            <div class="sp-menu" id="sp-menu">
                <a href="/home">
                    <h2 class="homeLogo">Theater Room</h2>
                </a>
                <div class="nav-button" v-on:click="open =! open">
                    <span class="line line_01" v-bind:class="{'open_btn01':open}"></span>
                    <span class="line line_02" v-bind:class="{'open_btn02':open}"></span>
                    <span class="line line_03" v-bind:class="{'open_btn03':open}"></span>
                </div>
                <transition name="menu">
                    <nav class="sp-menu-nav" v-show="open">
                        <ul class="sp-menu-list">
                            <li><i class="fa-solid fa-house icon"></i><a href="/home">ホーム</a></li>
                            <li><i class="fa-solid fa-user-plus icon"></i><a href="/friend">ともだち</a></li>
                            <li><i class="fa-solid fa-comments icon"></i><a href="/makeRoom">ルーム作成</a></li>
                            <li><i class="fa-solid fa-user icon"></i><a href="/edit">プロフィール編集</a></li>
                            <li><i class="fa-solid fa-circle-question icon"></i><a href="/contact">お問い合わせ</a></li>
                            <li><i class="fa-solid fa-user-graduate icon"></i><a href="/admin" onclick="return confirm('管理者画面に移動します')">管理者メニュー</a></li>
                            <li><i class="fa-solid fa-arrow-right-from-bracket icon"></i><a href="/logout" onclick="return confirm('ログアウトしますか？')">ログアウト</a></li>
                        </ul>
                    </nav>
                </transition>
            </div>
            <nav class="menu-nav">
                <ul class="menu-list">
                    <li><i class="fa-solid fa-house icon"></i><a href="/home">ホーム</a></li>
                    <li><i class="fa-solid fa-user-plus icon"></i><a href="/friend">ともだち</a></li>
                    <li><i class="fa-solid fa-comments icon"></i><a href="/makeRoom">ルーム作成</a></li>
                    <li><i class="fa-solid fa-user icon"></i><a href="/edit">プロフィール編集</a></li>
                    <li><i class="fa-solid fa-circle-question icon"></i><a href="/contact">お問い合わせ</a></li>
                    <li><i class="fa-solid fa-user-graduate icon"></i><a href="/admin" onclick="return confirm('管理者画面に移動します')">管理者メニュー</a></li>
                    <li><i class="fa-solid fa-arrow-right-from-bracket icon"></i><a href="/logout" onclick="return confirm('ログアウトしますか？')">ログアウト</a></li>
                </ul>
            </nav>
            <!-- bodyタグとhtmlタグにマウント出来ないのでコンテンツをdivで囲ってマウント-->
            <div id="app">
                @yield('content')
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script type="text/javascript" src="{{ asset('js/preview.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/tipMenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/humberger.js') }}"></script>
</html>