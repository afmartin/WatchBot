<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a responsive product landing page.">

    <title>WatchBot |  {{{ $title }}}</title>


<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">



<!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
  
<![endif]-->
<!--[if gt IE 8]><!-->
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
  
<!--<![endif]-->



<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">



  
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="{{{ asset("css/layouts/marketing-old-ie.css" ) }}}>
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="{{{ asset("css/layouts/marketing.css") }}}">
    <!--<![endif]-->
  


    

    

</head>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="{{{ url("/") }}}">WatchBot</a>

        <ul>

            <li class="pure-menu-selected"><a href="{{{ url("/") }}}">Home</a></li>
            <li><a href="{{{ url("videos") }}}">Videos</a></li>
            <li><a href="{{{ url("users") }}}">Profiles</a></li>
            @if( Auth::check() )
                <li><a href="{{{ url("logout") }}}">Logout</a></li>
            @else
                <li><a href="{{{ url("users/register") }}}">Sign Up</a></li>
            @endif  
        </ul>
    </div>
</div>

<div class="pure-g">
    <div class="l-box-lrg pure-u-1 pure-u-md-3-5">
        <br>
        @if(Session::has('errors'))
            <ul style="font-weight:bold; border: 2px RED solid;">
            @foreach( Session::pull('errors') as $error) 
                <li>{{{ $error }}}</li>
            @endforeach
            </ul>
        @endif 

        @if(Session::has('message'))
            <p style="font-weight:bold; border:2px black solid; text-align:center;">{{{ Session::pull('message') }}}</p>
        @endif

        @yield('content')
    </div>
    <div class="l-box-lrg pure-u-1 pure-u-md-2-5">
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
</div>
</body>
</html>
