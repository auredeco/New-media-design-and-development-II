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
    <ul class="pull-left list-inline">

        <li>
            <form action="/elections">
                <input type="text" name="keyword" id="keyword">
                <input type="submit" name="submit" value="Search">
            </form>
        </li>
        <li><a href="/elections">reset filters</a> </li>
    </ul>
    <ul class="pull-right">
        <l1>
            <a class="btn btn-default" href="/parties/create">New</a>
        </l1>
    </ul>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($parties as $item)
            <tr>
                <td><a href="/parties/{{$item->id}}">{{$item->name}}</a></td>
                <td><a href="/parties/{{$item->id}}">{{$item->description}}</a></td>
                <td><a href="/parties/{{$item->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="/parties/{{$item->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                <td>
                    <form id="delete_form{{$item->id}}" action="{{ URL::route('parties.destroy',$item->id) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id" name="id" value="{{ $item->id}}">
                        <a onclick="return (confirm('Are you sure you want to delete party with id {{$item->id}}'))?document.getElementById('delete_form{{$item->id}}').submit():null" href="javascript:{}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$parties->links()}}

@endsection