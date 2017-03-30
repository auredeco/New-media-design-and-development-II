@extends('master')
    @section('title')
        Users
    @endsection
    @section('content')
        <ul>
            @foreach($users as $item)
                <li><a href="/users/{{$item->id}}">{{$item->username}}</a></li>
            @endforeach
        </ul>
    @endsection
