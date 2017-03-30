@extends('master')
@section('title')
    Parties
@endsection
@section('content')

    <ul>
        @foreach($parties as $item)
            <li><a href="/parties/{{$item->id}}">{{$item->name}}</a></li>
        @endforeach
    </ul>
@endsection