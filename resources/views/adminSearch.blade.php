@extends('layout.menu')

@section('title','管理者を追加')

@section('content')    
    <div class="search">
        <div class="thumbnailBox">
            <img src="../thumbnails/{{ $user->icon_pass }}" class="thumbnail">
        </div>
        <h4>{{ $user['name'] }}</h4>
        <form action="/admin/register/add" method="post">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="id">
            <label for="password">
                <span>パスワード</span>
            </label>
            <input type="password" name="password" id="password">
            <button class="submitArea">
                <span>権限を付与</span>
            </button>
        </form>
    </div>
@endsection