@extends('master')
@section('title')
    Parties
@endsection
@section('navigation')
    <li  ><a href="/">Dashboard</a></li>
    <li ><a href="/users">Users</a></li>
    <li class="active" ><a href="/parties">Parties</a></li>
    <li ><a href="/referenda">Referenda</a></li>
    <li ><a href="/groups">Groups</a></li>
    <li ><a href="/elections">Elections</a></li>
@endsection
@section('navigation-right')
        <li ><a href="/settings">Settings</a></li>
        <li ><a href="/login">Login</a></li>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active" ><a href="/parties">Parties</a></li>
    </ol>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($parties as $item)
            <tr>
                <td><a href="/parties/{{$item->id}}">{{$item->name}}</a></td>
                <td><a href="/parties/{{$item->id}}">{{$item->description}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$parties->links()}}

@endsection