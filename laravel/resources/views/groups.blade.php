@extends('master')
@section('title')
    Groups
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
        <li class="active" ><a href="/groups">Groups</a></li>
    </ol>
@endsection
@section('content')
    <ul class="list-inline">
        <li>
            <form action="/groups">
                <input type="text" name="keyword" id="keyword">
                <input type="submit" name="submit" value="Search">
            </form>
        </li>
        <li><a href="/groups">reset filters</a> </li>
    </ul>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $item)
            <tr>
                <td><a href="/groups/{{$item->id}}">{{$item->name}}</a></td>
                <td><a href="/groups/{{$item->id}}">{{$item->description}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$groups->links()}}
@endsection