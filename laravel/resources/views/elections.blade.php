@extends('master')
@section('title')
    Elections
@endsection
@section('content')
    <ul>
        @foreach($elections as $item)
            <li><a href="/elections/{{$item->id}}">{{$item->name}}</a></li>
        @endforeach
    </ul>
@endsection
