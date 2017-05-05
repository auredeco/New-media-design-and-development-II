@extends('master')
@section('title')
    {{ ucfirst(trans($group->name))}} Detail
@endsection
@section('navigation')
    <li  ><a href="/">Dashboard</a></li>
    <li ><a href="/users">Users</a></li>
    <li ><a href="/parties">Parties</a></li>
    <li ><a href="/referenda">Referenda</a></li>
    <li class="active" ><a href="/groups">Groups</a></li>
    <li ><a href="/elections">Elections</a></li>
@endsection
@section('navigation-right')
        <li ><a href="/settings">Settings</a></li>
        <li ><a href="/login">Login</a></li>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
    <li><a href="/groups">Groups</a></li>
    <li class="active" ><a href="/groups/{{$group->id}}">{{$group->name}}</a></li>
    </ol>
@endsection
@section('content')
    <h3>description</h3>
    <p>{{$group->description}}</p>
    <h3> {{$users->total()}} users</h3>
    <table class="table">
        <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>E-mail</th>
            <th>Birthday</th>
            <th>Gender</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $item)
            <tr>
                <td><a href="/users/{{$item->id}}">{{$item->firstname}}</a></td>
                <td><a href="/users/{{$item->id}}">{{$item->lastname}}</a></td>
                <td><a href="/users/{{$item->id}}">{{$item->email}}</a></td>
                <td><a href="/users/{{$item->id}}">{{$item->birthdate}}</a></td>
                <td><a href="/users/{{$item->id}}">{{$item->gender}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}

@endsection