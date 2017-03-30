@extends('master')
@section('title')
    {{ ucfirst(trans($party->name))}} Detail
@endsection
@section('content')
    <ul>
        <li>{{$party->name}}</li>
    </ul>
@endsection