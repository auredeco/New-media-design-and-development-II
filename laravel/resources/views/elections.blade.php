@extends('master')
@section('title')
    Elections
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active" ><a href="/elections">Elections</a></li>
    </ol>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($elections as $item)
            <tr>
                <td><a href="/elections/{{$item->id}}">{{$item->id}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->name}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->description}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->isClosed? "Closed": "Open"}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$elections->links()}}
@endsection
