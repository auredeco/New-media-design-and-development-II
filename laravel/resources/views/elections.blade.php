@extends('master')
@section('title')
    Elections
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active" ><a href="/elections">Elections</a></li>
    </ol>
@endsection
@section('content')
    <ul class="list-inline">
        <li>status:
            <form action="/elections">
                <select name="keyword" onchange="this.form.submit()">
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'all') { ?>selected="true" <?php }}; ?> value="all">all</option>
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'open') { ?>selected="true" <?php }}; ?> value="open">open</option>
                    <option <?php if($_GET){ if ($_GET['keyword'] == 'closed') { ?>selected="true" <?php }}; ?> value="closed">closed</option>
                </select>
            </form>
        </li>
        <li>
            <form action="/elections">
                <input type="text" name="keyword" id="keyword">
                <input type="submit" name="submit" value="Search">
            </form>
        </li>
        <li><a href="/elections">reset filters</a> </li>
    </ul>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($elections as $item)
            <tr>
                <td><a href="/elections/{{$item->id}}">{{$item->id}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->name}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->description}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->isClosed? "Closed": "Open"}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$elections->links()}}
@endsection
