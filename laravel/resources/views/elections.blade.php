@extends('master')
@section('title')
    Elections
@endsection
@section('navigation')
    <li  ><a href="/">Dashboard</a></li>
    <li ><a href="/users">Users</a></li>
    <li ><a href="/parties">Parties</a></li>
    <li ><a href="/referenda">Referenda</a></li>
    <li ><a href="/groups">Groups</a></li>
    <li class="active" ><a href="/elections">Elections</a></li>
@endsection
@section('navigation-right')
        <li ><a href="/settings">Settings</a></li>
        <li ><a href="/login">Login</a></li>
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
