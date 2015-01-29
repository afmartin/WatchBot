@extends('master')

@section('content')
<h3>{{ $user->username }}'s Profile</h3>

<a href="{{ url("videos/from/" . $user->username) }}">View Videos Shared</a>

<h5>Email: {{ $user->email }}</h5>
<h5>Bio</h5>
<p>{{ $user->bio }}</p>

@stop
