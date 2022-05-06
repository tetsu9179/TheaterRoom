@extends('layout.menu')

@section('title','お問い合わせ')

@section('content')
    <div class="contact">
        <h3>お問い合わせ</h3>
        <form action="/contactResult" method="post">
            @csrf
            <label for="title">件名</label>
            <input type="text" name="title" id="title">
            @if($errors->has('contactContent'))
                @foreach($errors->get('contactContent') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
            @endif
            <label for="contactContent">お問い合わせ内容</label>
            <textarea name="contactContent" id="contactContent"></textarea>
            <button class=submitArea>
                <span>送信する</span>
            </button>
        </form>
    </div>
@endsection