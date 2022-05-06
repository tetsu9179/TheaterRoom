@extends('layout.menu')

@section('title','ホーム画面')

@section('content')
    <div class="search">
        <div class="thumbnailBox">
            <img src="../thumbnails/{{ $user->icon_pass }}" class="thumbnail">
        </div>
        <h4>{{ $user['name'] }}</h4>
        <form action="/addFriend" method="post">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="id">
            <input type="submit" value="追加">
        </form>
    </div>
@endsection