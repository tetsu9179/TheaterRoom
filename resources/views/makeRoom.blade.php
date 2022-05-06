@extends('layout.menu')

@section('title','ルーム作成')

@section('content')
    <form action="/addMember" method="post" enctype="multipart/form-data" class="makeRoom">
        <h3 class="pageTitle">ルームを作成</h3>
        @csrf
        <div class="previewSpace">
            <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" >
        </div>
        <label for="roomImage" class="inputImage">
            <img src="../images/uploadButton.png">
        </label>
        <input type="file" name="roomImage" id="roomImage" accept='image/*' onchange="previewImage(this);">
        <div class="roomName">
            <label for="name">ルーム名</label>
            <input type="text" name="name">
        </div>
        <button class="submitArea">
            <span>次へ</span>
        </button>
    </form>
@endsection