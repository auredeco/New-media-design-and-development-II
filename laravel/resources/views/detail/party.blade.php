@extends('master')
@section('title')
    {{ ucfirst(trans($party->name))}} Detail
@endsection
@section('navigation')
    <li  ><a href="/backoffice/">Dashboard</a></li>
    <li ><a href="/backoffice/users">Users</a></li>
    <li class="active" ><a href="/backoffice/parties">Parties</a></li>
    <li ><a href="/backoffice/referenda">Referenda</a></li>
    <li ><a href="/backoffice/groups">Groups</a></li>
    <li ><a href="/backoffice/elections">Elections</a></li>
@endsection
@section('navigation-right')
    <li ><a href="/backoffice/settings">Settings</a></li>
    <li ><a href="/backoffice/login">Login</a></li>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/backoffice/parties">Parties</a></li>
        <li class="active" ><a href="/backoffice/parties/{{$party->id}}">{{$party->name}}</a></li>
    </ol>
@endsection
@section('content')
    <form action="{{ URL::route('parties.destroy',$party->id) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a class="btn btn-default" href="/backoffice/parties/{{$party->id}}/edit">Edit</a>
        <button onclick="return confirm('Are you sure you want to delete this party')" class="btn btn-danger">Delete</button>
    </form>
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
                <td><a href="/backoffice/users/{{$item->user->id}}">{{$item->user->firstname}}</a></td>
                <td><a href="/backoffice/users/{{$item->user->id}}">{{$item->user->lastname}}</a></td>
                <td><a href="/backoffice/users/{{$item->user->id}}">{{$item->user->email}}</a></td>
                <td><a href="/backoffice/users/{{$item->user->id}}">{{$item->user->birthdate}}</a></td>
                <td><a href="/backoffice/users/{{$item->user->id}}">{{$item->user->gender}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {{$candidates->links()}}

@endsection