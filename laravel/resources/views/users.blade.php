@extends('master')
    @section('title')
        Users
    @endsection
@section('navigation')
    <li ><a href="/">Dashboard</a></li>
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
        <li class="active" ><a href="/users">Users</a></li>
    </ol>
@endsection
    @section('content')

        <ul class="list-inline">
            <li>Gender:
                <form action="/users">
                    <select>
                        <option>all</option>
                        <option name="keyword" value="Search">male</option>
                        <option name="keyword" value="Search">female</option>
                    </select>
                </form>
            <li>
                <form action="/users">
                    <input type="text" name="keyword" id="keyword">
                    <input type="submit" name="submit" value="Search">
                </form>
            </li>
        </ul>

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
