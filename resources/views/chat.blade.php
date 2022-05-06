@extends('layout.chatRoom')

@section('images')
    <div class="roomImage" style="background-image: url(../roomImage/{{ $room->thumbnail_pass }})"></div>
@endsection