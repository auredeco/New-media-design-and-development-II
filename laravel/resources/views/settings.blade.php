@extends('master')
@section('title')
    Settings
@endsection
@section('navigation')
    <li  ><a href="/">Dashboard</a></li>
    <li ><a href="/users">Users</a></li>
    <li ><a href="/parties">Parties</a></li>
    <li ><a href="/referenda">Referenda</a></li>
    <li ><a href="/groups">Groups</a></li>
    <li ><a href="/elections">Elections</a></li>
@endsection
@section('navigation-right')
        <li class="active" ><a href="/settings">Settings</a></li>
        <li ><a href="/login">Login</a></li>
@endsection
@section('content')
    Settings
@endsection