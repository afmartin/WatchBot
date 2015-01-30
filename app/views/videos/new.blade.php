@extends("master")

@section("content")
    <h3>Add a Video</h3>

    {{ Form::open(array('url' => 'videos/create')) }}

    {{Form::label("title", "Title")}}
    {{Form::text("title")}}

    {{Form::label("description", "Description")}}
    {{Form::textarea("description")}}

    {{Form::label("video", "YouTube  (URL)")}}
    {{Form::text("video")}}

    {{Form::submit("Submit", array(
                    'class' => 'pure-button pure-button- primary')) }}

    {{ Form::close() }}
@stop