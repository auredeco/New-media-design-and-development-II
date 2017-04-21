@extends('master')
@section('title')
    Referenda
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
        <li class="active" ><a href="/referenda">Referenda</a></li>
    </ol>
@endsection
@section('content')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Published</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($referenda as $item)
            <tr>
                <td><a href="/referenda/{{$item->id}}">{{$item->id}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->title}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->description}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->published? "Published": "Unpublished"}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->isClosed? "Closed": "Open"}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$referenda->links()}}
@endsection