@extends('master')

@section('content')

    <div style="text-align:center">

    <h3>Watching {{{ $video->title }}}</h3>
    <h4>Shared by: <a href="{{{ url("/videos/from/" . $video->user->username) }}}">{{{ $video->user->username }}}</a></h4>

    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{{ $video->video }}}" frameborder="0" allowfullscreen></iframe>

    <p>View count: {{{ $video->views }}}</p>
        <p>Added: {{{ $video->created_at }}}</p>
    <hr>
    <p>{{{ $video->description }}}</p>
    </div>
@stop