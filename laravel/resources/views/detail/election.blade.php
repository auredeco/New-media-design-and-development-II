@extends('master')
@section('title')
    {{ ucfirst(trans($election->name))}}

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
        <li class="active" ><a href="/elections/{{$election->id}}">{{$election->name}}</a></li>
    </ol>
@endsection
@section('content')

    <div class="col-xs-12 col-sm-9">
        @if($election->isClosed)
            <h4>Status: Closed</h4>
            <h3>results</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>party</th>
                    <th>score</th>
                </tr>
                </thead>
                <tbody>
                @foreach($election->candidates as $candidate)
                    <tr>
                        <td><a href="/users/{{$candidate->user->id}}">{{$candidate->id}}</a></td>
                        <td><a href="/users/{{$candidate->user->id}}">{{$candidate->user->firstname}} {{$candidate->user->lastname}}</a></td>
                        <td><a href="/parties/{{$candidate->party->id}}">{{$candidate->party->name}}</a></td>
                        <td>{{$candidate->pivot->score}}</td>
                        {{--<td>0</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <h4>Status: Open</h4>
            <h3>Candidates</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>party</th>
                </tr>
                </thead>
                <tbody>
                @foreach($election->candidates as $candidate)
                    <tr>
                        <td><a href="/groups/{{$candidate->user_id}}">{{$candidate->id}}</a></td>
                        <td><a href="/groups/{{$candidate->user_id}}">{{$candidate->user->firstname}} {{$candidate->user->lastname}}</a></td>
                        <td><a href="/parties/{{$candidate->party->id}}">{{$candidate->party->name}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>

    <div class="col-xs-12 col-sm-3 userInfo">
        <h3>info</h3>
        <table class="table">
            <tbody>
            <tr>
                <th>name</th>
                <td>{{$election->name}}</td>
            </tr>
            <tr>
                <th>description</th>
                <td>{{$election->description}}</td>
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
                <td>{{$election->startDate}}</td>
            </tr>
            <tr>
                <th>ends on</th>
                <td>{{$election->endDate}}</td>
            </tr>
            <tr>
                <th>time left</th>
                {{--TODO: Countdown--}}
                <td></td>
            </tr>

            </tbody>
        </table>
        <a class="btn btn-default" href="/elections/{{$election->id}}/edit">Edit</a>

    </div>
@endsection