@extends('master')
@section('title')
    {{ ucfirst(trans($referendum->title))}} Detail
@endsection
@section('navigation')
    <li  ><a href="/">Dashboard</a></li>
    <li ><a href="/users">Users</a></li>
    <li ><a href="/parties">Parties</a></li>
    <li class="active" ><a href="/referenda">Referenda</a></li>
    <li ><a href="/groups">Groups</a></li>
    <li ><a href="/elections">Elections</a></li>
@endsection
@section('navigation-right')
        <li ><a href="/settings">Settings</a></li>
        <li ><a href="/login">Login</a></li>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/referenda">Referenda</a></li>
        <li class="active" ><a href="/referenda/{{$referendum->id}}">{{$referendum->title}}</a></li>
    </ol>

@endsection
@section('content')
    <ul>
        <li>{{$referendum->title}}</li>
    </ul>
@endsection