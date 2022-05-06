@extends('layout.menu')

@section('title','プロフィールを編集')

@section('content')
<div class="register editProfile">
    <h3>プロフィールを編集</h3>
                <form action="/update" method="post" class="profileEditer" enctype="multipart/form-data">
                    @csrf
                    @if($errors->has('thumbnail'))
                        @foreach($errors->get('thumbnail') as $error)
                            <span class="error">{{ $error }}</span>
                        @endforeach
                    @endif
                    @if($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                            <span class="error">{{ $error }}</span>
                        @endforeach
                    @endif
                    <div class="profile">
                        <label for="thumbnail" class="thumbnailBox">
                            <img src="../thumbnails/{{ $user->icon_pass }}" id="preview" class="thumbnail">
                        </label>
                        <input type="file" name="thumbnail" id="thumbnail"  onchange="previewImage(this);">
                        <div class="profileText">
                            <label for="name">名前</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}">
                        </div>
                    </div>
                            
                        
                    <div class="registerInfo editInfo">
                        @if($errors->has('mail'))
                            @foreach($errors->get('mail') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                        <div class="registerRow">
                            <img src=../images/mail.png style="width:auto; height:auto;">
                            <div class="inputArea">
                                <label for="email">メールアドレス</label>
                                <input type="email" name="email" id="email" placeholder="xxxxxxx@example.com" value="{{ $user->email }}">
                            </div>
                        </div>
                            
                        @if($errors->has('tel'))
                            @foreach($errors->get('tel') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                        <div class="registerRow">
                            <img src=../images/tel.png style="width:auto; height:auto;">
                            <div class="inputArea">
                                <label for="tel">電話番号</label>
                                <input type="tel" name="tel" id="tel" placeholder="012345678901" 
                                    @if(!empty($user->tel))
                                        value="{{ $user->tel }}"
                                    @endif
                                >
                            </div>
                        </div>
                        @if($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                        <div class="registerRow">
                            <img src=../images/comment.png style="width:auto; height:auto;">
                            <div class="inputArea">
                                <label for="statesMsg">ひとこと</label> 
                                <input type="text" id="statesMsg" name="statesMsg">
                            </div>
                        </div>
                    </div>
                    <button class="submitArea">
                        <span>登録する</span>
                    </button>
                </form>
            </div>
@endsection