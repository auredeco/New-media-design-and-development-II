@extends('master')
@section('title')
    {{ ucfirst(trans($election->name))}} Detail
@endsection
@section('content')
    <ul>
        <li>{{$election->name}}</li>
    </ul>
@endsection