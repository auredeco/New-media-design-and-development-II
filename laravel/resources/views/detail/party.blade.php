@extends('master')
@section('title')
    {{ ucfirst(trans($party->name))}} Detail
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
        <li><a href="/parties">Parties</a></li>
        <li class="active" ><a href="/parties/{{$party->id}}">{{$party->name}}</a></li>
    </ol>
@endsection
@section('content')
    <ul>
        <li>{{$party->name}}</li>
    </ul>
@endsection