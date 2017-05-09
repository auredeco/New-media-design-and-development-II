@extends('master')
@section('title')
    Create new election
{{--    {{ ucfirst(trans($election->name))}}--}}

@endsection
@section('navigation')
    <li  ><a href="/">Dashboard</a></li>
    <li ><a href="/users">Users</a></li>
    <li ><a href="/parties">Parties</a></li>
    <li ><a href="/referenda">Referenda</a></li>
    <li ><a href="/groups">Groups</a></li>
    <li class="active" ><a href="/elections">Elections</a></li>
@endsection
@section('navigation-right')
    <li ><a href="/settings">Settings</a></li>
    <li ><a href="/login">Login</a></li>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/elections">Elections</a></li>
        <li class="active" >New</li>
    </ol>
@endsection
@section('content')
    <div class="col-xs-12 col-sm-9">
        <form method="POST" action="/elections">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="group">Group</label>
                <select id="group" name="group" class="form-control">
                    @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="form-group col-xs-6">
                    <label for="description">Start time</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="date" class="form-control col-xs-5" value="{{$datetime->toDateString()}}" id="startDate" name="startDate">
                        </div>
                        <div class="col-xs-6">
                            <input type="time" class="form-control col-xs-5" value="{{$datetime->toTimeString()}}" id="startTime" name="startTime">
                        </div>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label for="description">End time</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="date" class="form-control col-xs-5" id="endDate" name="endDate">
                        </div>

                        <div class="col-xs-6">
                            <input type="time" class="form-control col-xs-5" id="endTime" name="endTime">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
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