@extends('layout.admin')

@section('title','管理者メニュー')

@section('content')
    <div class="container">
        <div class="buttonContainer">
            <form action='/admin/contact' method="get">
                <input type="hidden" name="page" value="1">
                <button class="submitArea">
                    <span>問い合わせ内容を確認</span>
                </button>
            </form>
            <button class="submitArea adminButton" onclick="location.href='/admin/register'">
                <span>管理者を追加</span>
            </button>
        </div>
    </div>
@endsection
