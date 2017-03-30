@extends('master')
@section('title')
    Referenda
@endsection
@section('content')

    <ul>
        @foreach($referenda as $item)
            <li><a href="/referenda/{{$item->id}}">{{$item->title}}</a></li>
        @endforeach
    </ul>
@endsection