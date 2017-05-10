@extends('master')
    @section('title')
        Users
    @endsection
@section('navigation')
    <li ><a href="/backoffice/">Dashboard</a></li>
    <li class="active" ><a href="/backoffice/users">Users</a></li>
    <li ><a href="/backoffice/parties">Parties</a></li>
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
        <li class="active" ><a href="/backoffice/users">Users</a></li>
    </ol>
@endsection
    @section('content')

        <ul class="list-inline">
            <li>Gender:
                <form action="/backoffice/users">
                    <select name="keyword" onchange="this.form.submit()">
                        <option <?php if($_GET){ if ($_GET['keyword'] == 'all') { ?>selected="true" <?php }}; ?> value="all">all</option>
                        <option <?php if($_GET){ if ($_GET['keyword'] == 'male') { ?>selected="true" <?php }}; ?> value="male">male</option>
                        <option <?php if($_GET){ if ($_GET['keyword'] == 'female') { ?>selected="true" <?php }}; ?> value="female">female</option>
                    </select>
                </form>
            </li>
            <li>
                <form action="/backoffice/users">
                    <input type="text" name="keyword" id="keyword">
                    <input type="submit" name="submit" value="Search">
                </form>
            </li>
            <li><a href="/backoffice/users">reset filters</a> </li>
        </ul>

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
            @foreach($users as $item)
                <tr>
                    <td><a href="/backoffice/users/{{$item->id}}">{{$item->firstname}}</a></td>
                    <td><a href="/backoffice/users/{{$item->id}}">{{$item->lastname}}</a></td>
                    <td><a href="/backoffice/users/{{$item->id}}">{{$item->email}}</a></td>
                    <td><a href="/backoffice/users/{{$item->id}}">{{$item->birthdate}}</a></td>
                    <td><a href="/backoffice/users/{{$item->id}}">{{$item->gender}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    @endsection
