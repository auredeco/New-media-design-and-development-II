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
    <ul class="list-inline pull-left">
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
    <ul class="pull-right">
        <l1>
            <a class="btn btn-default" href="/elections/create">New</a>
        </l1>
    </ul>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>status</th>
            <th colspan="3">actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($elections as $item)
            <tr>
                <td><a href="/elections/{{$item->id}}">{{$item->id}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->name}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->description}}</a></td>
                <td><a href="/elections/{{$item->id}}">{{$item->isClosed? "Closed": "Open"}}</a></td>
                <td><a href="/referenda/{{$item->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="/referenda/{{$item->id}}/destroy"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                <td><a href="/referenda/{{$item->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$elections->links()}}
@endsection
