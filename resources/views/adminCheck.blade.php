@extends('layout.admin')

@section('title','管理者検索')

@section('content')
    <h3>管理者を追加</h3>
    <div class="friendAdd">
    @if(session('error'))
        <span class="error">{{ session('error') }}</span>
    @endif
    <form action="/admin/register" method="post">
        @csrf
        <input type="text" name="id" placeholder="メールアドレス">
        <input type="submit" value="検索">
    </form>
</div>
@endsection