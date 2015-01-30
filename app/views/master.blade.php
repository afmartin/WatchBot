<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="description" content="A layout example that shows off a responsive product landing page.">

    <title>WatchBot |  {{{ $title }}}</title>

    {{ HTML::style("css/master.css")}}
</head>
<body>
<div id="container">
<div class="banner"></div>
    <div class="menu">
        <ul>
            <li><a href="{{{ url("/") }}}">Home</a></li>
            <li><a href="{{{ url("videos") }}}">Videos</a></li>
            <li><a href="{{{ url("users") }}}">Profiles</a></li>
            @if( Auth::check() )
                <li><a href="{{{ url("logout") }}}">Logout</a></li>
            @else
                <li><a href="{{{ url("users/register") }}}">Sign Up</a></li>
            @endif  
        </ul>
    </div>

    <div class="main">
        <br>
        @if(Session::has('errors'))
            <ul style="font-weight:bold; border: 2px RED solid; margin:5px 5px 5px 5px; padding: 5px 5px 5px 5px;">
            @foreach( Session::pull('errors') as $error) 
                <li>{{{ $error }}}</li>
            @endforeach
            </ul>
        @endif 

        @if(Session::has('message'))
            <p style="padding: 5px 5px 5px 5px; margin:5px 5px 5px 5px; font-weight:bold; border:2px black solid; text-align:center;">{{{ Session::pull('message') }}}</p>
        @endif

        @yield('content')
    </div>
    <div class="side">
        @if( !Auth::check() )
        <br>
        <h3>Login</h3>

        <p>Welcome guest!  We recommend logging in to enjoy our services.</p>

        {{ Form::open(array('url' => 'login')) }}
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username') }}
        
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}

            {{ Form::submit('Log in', array(
                        'class' => 'pure-button pure-button-primary')) }}

        {{ Form::close() }}
        @else
        <br>
        <h3>
        Welcome back, {{{ Auth::user()->username }}}
        </h3>

        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie non erat vel convallis. Nulla facilisi. Duis felis justo, finibus eu dignissim ut, mattis nec nulla. Maecenas id porttitor nunc. Fusce euismod ligula eu sapien pretium, eu semper orci malesuada. 
        </p>

        <ul>
            <li><a href="{{{ url("users/edit") }}}">My Account</a></li>
            <li><a href="{{{ url("logout") }}}">Log out</a></li>
        </ul>


        @endif


        <h3>Videos to Watch</h3>

            @foreach ($side_videos as $side_vid)
                <a href="{{{ url("/videos/show/" . $side_vid->id ) }}}"><img src="http://i.ytimg.com/vi/{{{ $side_vid->video }}}/default.jpg"></a>
            @endforeach
    </div>
    <br style="clear:both;">
    </div>
</body>
</html>
