@extends('master')

@section('content')
<h3>{{{ $user->username }}}'s Profile</h3>
<br>
<a href="{{{ url("videos/from/" . $user->username) }}}">View Videos Shared</a>
<br><br>
<p>Email: {{{ $user->email }}}</p>
<p>Registered: {{{ $user->created_at }}}</p>
<h5>Bio</h5>
<p>{{{ $user->bio }}}</p>

@stop
