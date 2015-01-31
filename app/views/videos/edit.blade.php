@extends("master")

@section("content")
    <h3>Edit Video</h3>

{{ Form::open(array('url' => "videos/update/$video->id")) }}

{{Form::label("title", "Title")}}
{{Form::text("title", $video->title)}}

{{Form::label("description", "Description")}}
{{Form::textarea("description", $video->description)}}

<br>
{{Form::submit("Submit", array(
                'class' => 'pure-button pure-button- primary')) }}

{{ Form::close() }}

    <a href="{{{ url("/videos/destroy/$video->id") }}}">Delete Video</a>
@stop