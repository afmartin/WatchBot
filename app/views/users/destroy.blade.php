@extends("master")

@section("content")


<h3>Delete Account</h3>

<p style="color:red; font-weight:bolder;">THIS ACTION IS PERMANENT</p>

{{ Form::open(array('url' => 'users/destroy', 'class' => "pure-form pure-form-stacked")) }}

    {{ Form::label('password', "Confirm Password") }}
    {{ Form::password('password') }}

    {{ Form::submit("Delete Account", array('class' => 'pure-button pure-botton-primary',
                                            'onclick' => 'return confirm("Are you sure you want to do that?")')) }}

{{ Form::close() }}

@stop    
