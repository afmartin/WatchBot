{{ Form::open(array('url' => 'videos/create', 'class' => "pure-form pure-form-stacked")) }}

    {{Form::label("title", "Title")}}
    {{Form::text("title")}}

    {{Form::label("description", "Description")}}
    {{Form::textarea("description")}}

    {{Form::label("video", "YouTube Video")}}
    {{Form::text("video")}}

    {{Form::submit("Submit", array(
                    'class' => 'pure-button pure-button- primary')) }}

{{ Form::close() }}
