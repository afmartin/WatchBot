@extends('master')

@section('content')

<h3>Register</h3>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit lacus aliquam, hendrerit tortor sed, aliquet nunc. Aenean et facilisis ligula, sed ultrices lacus. Morbi porta gravida lacus, eu bibendum justo dignissim a. In venenatis hendrerit sapien, at aliquam risus commodo vitae. Curabitur consequat massa faucibus condimentum volutpat. Nulla efficitur nulla neque, in commodo tortor tincidunt a. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In imperdiet risus odio, et ullamcorper velit dignissim ut. Ut porta pulvinar diam non gravida. </p>
{{ Form::open(array('url' => 'users/register', 'class' => "pure-form pure-form-stacked")) }}
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email') }}

    {{ Form::label('username', 'Username') }}
    {{ Form::text('username') }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}

    {{ Form::label('password_confirmation', 'Confirm Password') }}
    {{ Form::password('password_confirmation') }}

    {{ Form::submit("Register", array(
                          'class' => 'pure-button pure-button- primary')) }}
{{ Form::close() }}
@stop

