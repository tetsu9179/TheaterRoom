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
            <div class="register" id="app">
                <form action="/addUser" method="post" class="profileEditer" enctype="multipart/form-data">
                    @csrf
                    <div class="registerInfo">
                        @if($errors->has('thumbnail'))
                        @foreach($errors->get('thumbnail') as $error)
                        <span class="error">{{ $error }}</span>
                        @endforeach
                        @endif
                        <div class="thumbnailBox">
                            <label for="thumbnail">
                                <img src="../images/userIcon.png" id="preview">
                            </label>
                            <input type="file" name="thumbnail" id="thumbnail" onchange="previewImage(this);">
                        </div>
                        @if($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                        <span class="error">{{ $error }}</span>
                        @endforeach
                        @endif
                        <h3 class="registerLogo">アカウントを作成</h3>
                        <div class="registerRow">
                            <img src=../images/profile.png>
                            <div class="inputArea">
                                <label for="name">名前</label>
                                <input type="text" name="name" id="name" placeholder="例)山田　五郎">
                            </div>
                        </div>
                        @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                        <div class="registerRow">
                            <img src=../images/mail.png>
                            <div class="inputArea">
                                <label for="email">メールアドレス</label>
                                <input type="email" name="email" id="email" placeholder="xxxxxxx@example.com">
                            </div>
                        </div>
                        @if($errors->has('tel'))
                            @foreach($errors->get('tel') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                        <div class="registerRow">
                            <img src=../images/tel.png>
                            <div class="inputArea">
                                <label for="tel">電話番号</label>
                                <input type="tel" name="tel" id="tel" placeholder="012345678901">
                            </div>
                        </div>
                        @if($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                        <div class="registerRow">
                            <img src=../images/password.png>
                            <div class="inputArea">
                                <label for="password">パスワード</label> 
                                <input type="password" name="password" id="password">
                            </div>
                        </div>  
                        
                        
                        <div class="registerRow">
                            <img src=../images/comment.png>
                            <div class="inputArea">
                                <label for="statesMsg">ひとこと</label> 
                                <input type="text" id="statesMsg" name="statesMsg">
                            </div>
                        </div>
                    
                        <button class="submitArea">
                            <span>登録する</span>
                        </button>
                        <button type="button" class="submitArea subButton" v-on:click="select('1')">
                            <span>戻る</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script type="text/javascript" src="{{ asset('js/tipMenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/preview.js') }}"></script>
</html>