@extends('master')
@section('title')
        {{ ucfirst(trans($user->username))}} Detail
@endsection
@section('content')
<ul>
        <li>{{$user->username}}</li>
</ul>
@endsection