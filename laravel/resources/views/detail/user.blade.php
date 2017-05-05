@extends('master')
@section('title')
        {{ ucfirst(trans($user->username))}}
@endsection
@section('navigation')
        <li  ><a href="/">Dashboard</a></li>
        <li class="active" ><a href="/users">Users</a></li>
        <li ><a href="/parties">Parties</a></li>
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
                <li><a href="/users">Users</a></li>
                <li class="active" ><a href="/users/{{$user->id}}">{{$user->name}}</a></li>
        </ol>
@endsection
@section('content')
    <div class="col-xs-12 col-sm-3">
        <img src="{{$user->pictureUri}}" width="100%">

    </div>

    <div class="col-xs-12 col-sm-9 userInfo">
        <h3>info</h3>
        <table class="table">
            <tbody>
            <tr>
                <th>name</th>
                <td>{{$user->firstname}} {{$user->lastname}}</td>
            </tr>
            <tr>
                <th>last login</th>
                <td>{{$user->lastLogin}}</td>
            </tr>
            <tr>
                <th>gender</th>
                <td>{{$user->gender}}</td>
            </tr>
            <tr>
                <th>age</th>
                <td>{{$age}}</td>
            </tr>
            </tbody>
        </table>
        <h3>groups</h3>
        @if(!$groups->isEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $item)
                    <tr>
                        <td><a href="/groups/{{$item->id}}">{{$item->id}}</a></td>
                        <td><a href="/groups/{{$item->id}}">{{$item->name}}</a></td>
                        <td><a href="/groups/{{$item->id}}">{{$item->description}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <p>This user is not active in any groups</p>
        @endif

    </div>





@endsection