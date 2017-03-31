@extends('master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="dashUsers">
        <h2>Users</h2>
        <ul>
            @foreach($all[0] as $item)
                <li><a href="/users/{{$item->id}}">{{$item->username}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="dashGroups">
        <h2>Groups</h2>
        <ul>
            @foreach($all[1] as $item)
                <li><a href="/groups/{{$item->id}}">{{$item->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="dashParties">
        <h2>Parties</h2>
        <ul>
            @foreach($all[2] as $item)
                <li><a href="/parties/{{$item->id}}">{{$item->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="dashReferenda">
        <h2>Referenda</h2>
        <ul>
            @foreach($all[3] as $item)
                <li><a href="/referenda/{{$item->id}}">{{$item->title}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="dashElections">
        <h2>Elections</h2>
        <ul>
            @foreach($all[4] as $item)
                <li><a href="/users/{{$item->id}}">{{$item->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
