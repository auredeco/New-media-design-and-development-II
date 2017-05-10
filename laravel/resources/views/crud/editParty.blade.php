@extends('master')
@section('title')
    Edit {{ ucfirst(trans($party->name))}}


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
        <li><a href="/backoffice/parties/{{$party->id}}">{{$party->name}}</a></li>
        <li class="active" >edit</li>
    </ol>
@endsection
@section('content')
    <div class="col-xs-12 col-sm-9">
        <form action="{{action('PartyController@update',['id'=>$party->id])}}" method="post">
            <input type="hidden" name="_method" value="PATCH">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{$party->name}}" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{$party->description}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">submit</button>
            </div>
        </form>
    </div>
    <div class="col-xs-12 col-sm-3 errors">
        @include('partials.error')
    </div>
@endsection