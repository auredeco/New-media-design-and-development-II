@extends('master')
@section('title')
    {{ ucfirst(trans($referendum->title))}} Detail
@endsection
@section('content')
    <ul>
        <li>{{$referendum->title}}</li>
    </ul>
@endsection