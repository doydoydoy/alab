<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/4a55acc96a.js"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">

    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <style type="text/css">

        #banner
        {
            background: #708090; 
            display: none; 
            color: #fff;
            padding-top: 15px;
        }

        .breadcrumb
        {
            background-color: crimson;
            border: 1px solid white;
            color: white;
            border-radius: 3px;
        }

        .breadcrumb a, .breadcrumb .active
        {
            color: #f5f5f5;
        }

        .breadcrumb a
        {
            font-weight: bold;
        }

        .section-title, .section-title a
        {
            background: #DC143C; 
            color: white; 
            font-weight: bold;
        }

        .navbar
        {
            margin-bottom: 0px;
        }

        #app
        {
            margin-top: 20px;
        }

        #content
        {
            padding: 20px 30px;
            position: relative;
            background: white;
            min-height: 500px;
        }

        .sections
        {
            border-top: 1px solid #d3e0e9; 
            border-right: 1px solid #d3e0e9; 
            border-left: 1px solid #d3e0e9; 
            border-radius: 2px;
            margin-bottom: 20px;
        }

        .indicators, .indicators-2
        {
            display: none;
        }

        .no-float
        {
            float: none;
        }

        .border-bottom
        {
            padding-top: 5px;
            padding-bottom: 5px;
            border-bottom: 1px solid #d3e0e9;
            overflow: hidden;
        }

        .circle
        {
            height: 50px; 
            width: 50px;
            border-radius: 50%; 
            color: white;
        }

        .block
        {
            display: block;
        }

        .thread-sub
        {
            white-space: nowrap;
            text-overflow: ellipsis;
            display: block;
            overflow: hidden
        }

        .thread-post
        {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .show-400px
        {
            display: none;
        }

        footer
        {
            margin-bottom: 30px;
        }

        @media screen and (max-width: 992px)
        {
            #content
            {
                min-height: 400px;
            }
        }

        @media screen and (max-width: 768px)
        {
            #banner, .hide-768px
            {
                display: none;
            }

            .indicators
            {
                display: initial;
            }

        }

        @media screen and (max-width: 500px)
        {
            .latest
            {
                display: none;
            }

            .indicators-2
            {
                display: inline;
            }

            .full-mobile
            {
                width: 100%;
            }
            
            .circle
            {
                width: 40px;
                height: 40px;
            }

            #content
            {
                padding: 10px;
            }
        }

        @media screen and (max-width: 400px)
        {
            .encircle
            {
                display: none;
            }

            .thread-post
            {
                width: 100%;
                padding-bottom: 5px;
                padding-top: 5px;
            }

            .show-400px
            {
                display: block;
            }
        }

    </style>
</head>
<body>


    @if(Auth::guest() && (!(Request::url() === route('login')) && !(Request::url() === route('register'))))
    <div id="banner" style="@if($errors->any()) display: block; @endif">
        <div class="container">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-sm-4 control-label">E-Mail Address</label>

                    <div class="col-sm-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-sm-4 control-label">Password</label>

                    <div class="col-sm-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endif

    <div id="app">
        <div class="container">
            <div style="background: url(http://www.erenikiz.com/wp-content/uploads/2016/03/2119436.jpg) center/cover no-repeat; height: 150px; position: relative; color: white; border: 1px solid transparent" class="text-center">
                <h1 style="font-family: 'Permanent Marker', cursive; color: white; font-size: 5vw; opacity: 0.9;">Alab</h1>
                <h2 style="font-size: 2vw; font-family: 'Permanent Marker', cursive; opacity: 0.8;">n. Aral Laboratory</h2>
            </div>

            <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav collapse">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" style="padding-right: 15px;">
                        <!-- Authentication Links -->
                        @if(Auth::guest())
                            @if(Request::url() === route('login') || Request::url() === route('register'))
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @else    
                                <li><a href="#" id="login">Login</a></li>
                            @endif
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="#"><span>{{ Auth::user()->username }}</span></a></li>

                            <li class="dropdown">
                                

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                     <span class="glyphicon glyphicon-cog"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Messages</a></li>
                                    <li><a href="#">Settings</a></li>
                                    @if(Auth::user()->role == 'admin')
                                        <li><a href="#">Admin Settings</a></li> 
                                    @endif
                                    <li class="divider" role="separator"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>

        <div class="container">
            <div id="content">

                @if(isset($crumbs))
                <ol class="breadcrumb">
                    <?php $end_crumb = end($crumbs); ?>
                    @foreach($crumbs as $crumb => $route)
                        @if($route == $end_crumb)
                        <li class="active">{{$crumb}}</li>
                        @else
                        <li><a href='{{ url("/".$route) }}'>{{$crumb}}</a></li>
                        @endif
                    @endforeach
                </ol>
                @endif

                @yield('content')
            </div>
        </div>

        <footer class="container">
            <div style="background: firebrick; height: 30px;">
                
            </div>
        </footer>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

    <script type="text/javascript">

        $('#login').click(function(e)
        {
            if($(window).width()>768)
            {
                if($('#banner').css('display')=='none')
                {
                    $('#banner').slideDown('medium');
                    $('.overlay').css('opacity', '0.5');
                }
            }
            else
            {   
                window.location.href = '{{ route('login') }}';
            }
        });
        $('#closeBanner').click(function(e)
        {
            $('#banner').slideUp('medium');
            $('.overlay').css('opacity', '1');
        });
        $(document).mouseup(function (e)
        {
            var container = $("#banner");

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                container.slideUp('medium');
                $('.overlay').css('opacity', '1');
            }
        });

        $(document).ready(function() 
        {
            $('#summernote').summernote(
            {
                  height: 300,                 // set editor height
                  minHeight: 300,             // set minimum height of editor
                  maxHeight: 300,             // set maximum height of editor
                  focus: true                  // set focus to editable area after initializing summernote
            });

        });

    </script>

</body>
</html>

<?php ob_end_flush(); ?>