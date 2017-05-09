@extends('master')
@section('title')
    Edit {{ ucfirst(trans($group->name))}}

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
        <li><a href="/groups/{{$group->id}}">{{$group->name}}</a></li>
        <li class="active" >edit</li>
    </ol>
@endsection
@section('content')
    <div class="col-xs-12 col-sm-9">
        <form action="{{action('GroupController@update',['id'=>$group->id])}}" method="post">
            <input type="hidden" name="_method" value="PATCH">
            {{csrf_field()}}
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{$group->name}}" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{$group->description}}</textarea>
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