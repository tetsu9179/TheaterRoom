@extends('layout.menu')

@section('title','友達メニュー')

@section('content')
<nav class="tipMenu">
    <ul class="tipTag friendTag">
        <li v-on:click="select('1')" v-bind:class="{'select': isSelected === '1'}">友達</li>
        <li v-on:click="select('2')" v-bind:class="{'select': isSelected === '2'}">友達リクエスト</li>
        <li v-on:click="select('3')" v-bind:class="{'select': isSelected === '3'}">友達を探す</li>
    </ul>
</nav>
<div class="friendsList" v-if="isSelected === '1'" key="friend">
    @if(empty($friends))
        <h3><a href>友達を探す</a></h3>
    @else
        @foreach($friends as $friend)
        <div class="profile">
            <div class="thumbnailBox">
                <img src="../thumbnails/{{ $friend->icon_pass }}" class="thumbnail">
            </div>
            <div class="profileText">
                <h4>{{ $friend->name }}</h4>
                @if(!empty($friend->profile_messege))
                    <p>{{ $friend->profile_messege }}</p>
                @endif
            </div>
        </div>
        @endforeach
    @endif
</div>
<div class="friendRequests" v-else-if="isSelected === '2'" key="friend">
    @if(empty($getRequests))
        <h3>保留しているリクエストはありません</h3>
    @else
        @foreach($getRequests as $requestFriend)
        <div class="profile">
            <div class="thumbnailBox">
                <img src="../thumbnails/{{ $requestFriend->icon_pass }}" class="thumbnail">
            </div>
            <div class="profileText">
                <h4>{{ $requestFriend->name }}<h4>
                @if(!empty($requestFriend->profile_messege))
                    <p>{{ $requestFriend->profile_messege }}</p>
                @endif
            </div>
            <div class="button">
                <form action="/addFriend" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $requestFriend->id }}">
                    <button class="submitArea add">
                        <span>追加</span>
                    </button>
                    <button class="submitArea remove" formaction="/rejection">
                        <span>削除</span>
                    </button>
                </form> 
            </div>
        </div>
        @endforeach
    @endif
</div>
<div class="friendAdd" v-else-if="isSelected === '3'" key="friend">
    @if(session('error'))
        <span class="error">{{ session('error') }}</span>
    @endif
    <form action="/request" method="post">
        @csrf
        <input type="text" name="id" placeholder="メールアドレス、または電話番号">
        <input type="submit" value="検索">
    </form>
</div>
@endsection  