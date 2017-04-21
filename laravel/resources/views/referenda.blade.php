@extends('master')
@section('title')
    Referenda
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
        <li class="active" ><a href="/referenda">Referenda</a></li>
    </ol>
@endsection
@section('content')
    <ul class="list-inline">
        <li>status:
            <form action="/referenda">
                <select name="keyword" onchange="this.form.submit()">
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'all') { ?>selected="true" <?php }}; ?> value="all">all</option>
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'open') { ?>selected="true" <?php }}; ?> value="open">open</option>
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'closed') { ?>selected="true" <?php }}; ?> value="closed">closed</option>
                </select>
            </form>
        </li>
        <li>published:
            <form action="/referenda">
                <select name="keyword" onchange="this.form.submit()">
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'all') { ?>selected="true" <?php }}; ?> value="all">all</option>
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'published') { ?>selected="true" <?php }}; ?> value="published">published</option>
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'unpublished') { ?>selected="true" <?php }}; ?> value="unpublished">unpublished</option>
                </select>
            </form>
        </li>
        <li>
            <form action="/referenda">
                <input type="text" name="keyword" id="keyword">
                <input type="submit" name="submit" value="Search">
            </form>
        </li>
        <li><a href="/referenda">reset filters</a> </li>
    </ul>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Published</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($referenda as $item)
            <tr>
                <td><a href="/referenda/{{$item->id}}">{{$item->id}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->title}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->description}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->published? "Published": "Unpublished"}}</a></td>
                <td><a href="/referenda/{{$item->id}}">{{$item->isClosed? "Closed": "Open"}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$referenda->links()}}
@endsection