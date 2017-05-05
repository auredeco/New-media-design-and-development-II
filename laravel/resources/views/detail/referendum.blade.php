@extends('master')
@section('title')
    {{ ucfirst(trans($referendum->title))}} Detail
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
        <li><a href="/referenda">Referenda</a></li>
        <li class="active" ><a href="/referenda/{{$referendum->id}}">{{$referendum->title}}</a></li>
    </ol>

@endsection
@section('content')
    <div class="col-xs-12 col-sm-9">
        @if($referendum->isClosed)
            <h4>Status: Closed</h4>
            <h3>results</h3>
            <p>{{$referendum->description}}</p>

            <ul>
                <li>agree:{{$agree}}</li>
                <li>disagree:{{$disagree}}</li>
                <li>total:{{$total}}</li>
            </ul>

        @else
            <h4>Status: Open</h4>
            <h3>Referendum</h3>
            <p>{{$referendum->description}}</p>
        @endif

    </div>

    <div class="col-xs-12 col-sm-3 userInfo">
        <h3>info</h3>
        <table class="table">
            <tbody>
            <tr>
                <th>name</th>
                <td>{{$referendum->title}}</td>
            </tr>
            <tr>
                <th>created by</th>
                <td>{{$votemanager->username}}</td>
            </tr>
            <tr>
                <th>group</th>
                <td>{{$group->name}}</td>
            </tr>
            <tr>
                <th>started on</th>
                <td>{{$referendum->startDate}}</td>
            </tr>
            <tr>
                <th>ends on</th>
                <td>{{$referendum->endDate}}</td>
            </tr>
            <tr>
                <th>time left</th>
                {{--TODO: Countdown--}}
                <td></td>
            </tr>

            </tbody>
        </table>

    </div>
@endsection