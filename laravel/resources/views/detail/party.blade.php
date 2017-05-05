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
    <h3>description</h3>
    <p>{{$party->description}}</p>
        <h3> {{$candidates->total()}} Candidates</h3>
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
        @foreach($candidates as $item)
            <tr>
                <td><a href="/users/{{$item->user->id}}">{{$item->user->firstname}}</a></td>
                <td><a href="/users/{{$item->user->id}}">{{$item->user->lastname}}</a></td>
                <td><a href="/users/{{$item->user->id}}">{{$item->user->email}}</a></td>
                <td><a href="/users/{{$item->user->id}}">{{$item->user->birthdate}}</a></td>
                <td><a href="/users/{{$item->user->id}}">{{$item->user->gender}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {{$candidates->links()}}

@endsection