@extends('master')

@section('content')

    <div style="text-align:center">

    <h3>{{ $video->title }}</h3>
    <h4>{{ $video->user->username }}</h4>

    <iframe width="853" height="430" src="https://www.youtube.com/embed/{{ $video->video }}" frameborder="0" allowfullscreen></iframe>

    <p>{{ $video->views }}</p>

    <p>{{ $video->description }}</p>
    </div>
@stop