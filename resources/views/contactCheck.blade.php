@extends('layout.admin')

@section('title','管理者メニュー')

@section('content')
    <h3>お問い合わせ一覧</h3>
        <table class="contactTable">
            <tr>
                <th>連絡先</th>
                <th>件名</th>
                <th>メッセージ</th>
            </tr>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->title }}</td>
                <td class="message">{{ $contact->message }}</td>
            </tr>
            @endforeach
        </table>
@endsection