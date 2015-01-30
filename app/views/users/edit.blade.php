@extends("master")


@section("content")
<h3>Edit Profile</h3>

{{ Form::open(array('url' => 'users/update', 'class' => "pure-form pure-form-stacked")) }}
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', $user->email ) }}

    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', $user->username) }}

    {{ Form::label('bio', 'Enter your bio') }}
    {{ Form::textarea('bio', $user->bio) }}


    {{ Form::label('old_password', 'Old Password') }}
    {{ Form::password('old_password') }}

    {{ Form::label('password', 'New Password') }}
    {{ Form::password('password') }}
    
    {{ Form::label('password_confirmation', 'Confirm New Password') }}
    {{ Form::password('password_confirmation') }}


    {{ Form::submit("Update", array(
                    'class' => 'pure-button pure-button-primary')) }}

    {{ Form::close() }}

<a href="{{{ url("users/destroy") }}}">Delete Account</a>

@stop
