@extends('master')
@section('title')
    Dashboard
@endsection
@section('navigation')
    <li class="active" ><a href="/">Dashboard</a></li>
    <li ><a href="/users">Users</a></li>
    <li ><a href="/parties">Parties</a></li>
    <li ><a href="/referenda">Referenda</a></li>
    <li ><a href="/groups">Groups</a></li>
    <li ><a href="/elections">Elections</a></li>

@endsection
@section('navigation-right')
        <li ><a href="/settings">Settings</a></li>
        <li ><a href="/login">Login</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="dashUsers col-xs-12 col-sm-6 col-md-4">
            <a href="/users"><h2>Users</h2></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Firstname</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($all[0] as $item)
                    <tr>
                        <td><a href="/users/{{$item->id}}">{{$item->lastname}}</a></td>
                        <td><a href="/users/{{$item->id}}">{{$item->firstname}}</a></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <b><a href="/users">Show all users...</a></b>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="dashGroups col-xs-12 col-sm-6 col-md-4">
            <a href="/groups"><h2>Groups</h2></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Group</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($all[1] as $item)
                    <tr>
                        <td><a href="/groups/{{$item->id}}">{{$item->name}}</a></td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="2">
                            <b><a href="/groups">Show all groups...</a></b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="dashParties col-xs-12 col-sm-6 col-md-4">
            <a href="/parties"><h2>Parties</h2></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Party</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all[2] as $item)
                        <tr>
                            <td><a href="/parties/{{$item->id}}">{{$item->name}}</a></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            <b><a href="/parties">Show all parties...</a></b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="dashReferenda col-xs-12 col-sm-6 col-md-4">
            <a href="/referenda"><h2>Referenda</h2></a>
            <table class="table">
                <thead>
                <tr>
                    <th>Referendum</th>
                    {{--<th>Eind datum</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($all[3] as $item)
                    <tr>
                        <td><a href="/referenda/{{$item->id}}">{{$item->title}}</a></td>
{{--                        <td><a href="/referenda/{{$item->id}}">{{$item->end_date}}</a></td>--}}
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <b><a href="/referenda">Show all referenda...</a></b>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="dashElections col-xs-12 col-sm-6 col-md-4">
            <a href="/elections"><h2>Elections</h2></a>
            <table class="table">
                <thead>
                <tr>
                    <th>Election</th>
                    <th>Eind datum</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all[4] as $item)
                    <tr>
                        <td><a href="/elections/{{$item->id}}">{{$item->name}}</a></td>
                        <td>
                            <a href="/elections/{{$item->id}}">
                                {{ Carbon\Carbon::parse($item->endDate)->format('d/m/Y') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <b><a href="/elections">Show all elections...</a></b>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

@endsection
