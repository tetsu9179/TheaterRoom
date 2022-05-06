@extends('layout.menu')

@section('title','友達を招待')

@section('content')
@if(isset($result))
    <div class="modal">
        <form action="/chat" method="post" class="modal-window">
        @csrf
            <p>{{ $result }}</p>
            <input type="hidden" value="{{ $talkroom->id }}" name="room">
            <input type="submit" value="開く">
        </form>
    </div>
@endif
@if(isset($message))
    {{ $message }}
@endif

    <form action="/room" method="post">
    <input type="hidden" value="{{ $talkroom->id }}" name="room">
    @csrf
    @foreach($friends as $friend)
        <label for="{{ 'friend'.$friend->id }}">
            <div class="profile">
                <div class="thumbnailBox">
                    <img src="../thumbnails/{{ $friend->icon_pass }}" class="thumbnail">
                </div>
                <div class="profileText addUserText">
                    <h4>{{ $friend->name }}<h4>
                    @if( !empty($friend->profile_messege) )
                        <p>{{ $friend->profile_messege }}</p>
                    @endif
                </div>
                <input type="checkbox" value="{{ $friend->id }}" name="friends[]" id="{{ 'friend'.$friend->id }}">
            </div>
        </label>
    @endforeach
        <button class="submitArea">
            <span>作成</span>
        </button>
    </form>
@endsection  