@extends('layout.menu')

@section('title','ホーム画面')

@section('content')
    <div class="profile">
        <div class="thumbnailBox">
            <img src="../thumbnails/{{ $user->icon_pass }}" class="thumbnail">
        </div>
        <div class="profileText">
            <h4>{{ $user['name'] }}</h4>
            @if(!empty($user['profile_messege']))
                <p>{{ $user['profile_messege'] }}</p>
            @endif
        </div>
    </div>
    <nav class="tipMenu">
        <ul class="tipTag1">
            <li v-on:click="select('1')" v-bind:class="{'select': isSelected === '1'}">作成したルーム</li>
            <li v-on:click="select('2')" v-bind:class="{'select': isSelected === '2'}">招待されたルーム</li>
        </ul>
    </nav>
    <div class="talkRoomList" id="myTalkRoom" v-if="isSelected === '1'">
        @if(empty($myTalkRoom))
            <div class="emptyMessage">
                <h3>トークルームが作成されていません</h3>
                <p><a href="/makeRoom">トークルームを作ろう</a></p>
            </div>
        @else
            @foreach($myTalkRoom as $TalkRoom)
                <div class="roomForm">
                    <form action="/chat" method="post">
                        @csrf
                        <input type="hidden" value="{{ $TalkRoom->id }}" name="room">
                        <input type="submit" value="" class="roombutton" style="background-image:url('../roomImage/{{ $TalkRoom->thumbnail_pass }}')">
                    </form>
                </div>
            @endforeach
        @endif
    </div>
    <div class="talkRoomList" id="invidedTalkRoom" v-else-if="isSelected === '2'">
        @if(empty($invitedTalkRoom))
            <h3>招待されたトークルームはありません</h3>
        @else
            @foreach($invitedTalkRoom as $TalkRoom)
                <div class="roomForm">
                    <form action="/chat" method="post">
                        @csrf
                        <input type="hidden" value="{{ $TalkRoom->id }}" name="room">
                        <input type="submit" value="" class="roombutton" style="background-image:url('../roomImage/{{ $TalkRoom->thumbnail_pass }}')">
                    </form>
                </div>
            @endforeach
        @endif
    </div>
@endsection