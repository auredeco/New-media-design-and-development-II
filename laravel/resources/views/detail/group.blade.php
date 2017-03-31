@extends('master')
@section('title')
    {{ ucfirst(trans($group->name))}} Detail
@endsection
@section('content')
    <ul>
        <li>{{$group->name}}</li>
    </ul>
@endsection