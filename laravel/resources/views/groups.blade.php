@extends('master')
@section('title')
    Groups
@endsection
@section('content')

    <ul>
        @foreach($groups as $item)
            <li><a href="/groups/{{$item->id}}">{{$item->name}}</a></li>
        @endforeach
    </ul>
@endsection