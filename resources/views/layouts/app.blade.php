<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('page_description')">
    <meta name="author" content="@yield('page_author')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') - {{ Config::get('settings.site_name')  }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset( 'assets/bootstrap/bootstrap.min.css' )  }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset( 'assets/css/main.css' )  }}" rel="stylesheet">
</head>
<body cz-shortcut-listen="true">
    <div class="blog-masthead">
        <div class="container">
            <nav class="nav float-left">
                <a class="nav-link @yield('current_page_home')" href="/">Home</a>
                <a class="nav-link @yield('current_page_managment')" href="/posts/">Management</a>
            </nav>
            <nav class="nav float-right">
                @if(Auth::check())
                    <div class="nav-link dropdown">
                        <button class="dropdown-toggle logged_user_info" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-name="{{ Auth::user()->name  }}" data-image="{{ asset('/')  }}{{ Auth::user()->image }}">
                            <img src="{{ asset('/')  }}{{ Auth::user()->image }}"> {{ Auth::user()->name  }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @else
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                @endif
            </nav>
            <div class="clear"></div>
        </div>
    </div>
    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">{{ Config::get('settings.site_name')  }}</h1>
            <p class="lead blog-description">{{ Config::get('settings.site_desc')  }}</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
                @yield('content')
            </div>
            <div class="col-sm-4 offset-sm-1 blog-sidebar">
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <footer class="blog-footer">
        <p>An example Laravel CRUD application by <a href="#">Stoyan Kostadinov</a></p>
        <p>Boostrap HTML Template by <a href="https://getbootstrap.com/docs/4.0/examples/blog/#">Bootstrap</a></p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset( 'assets/js/popper.min.js' )  }}"></script>
    <script src="{{ asset( 'assets/bootstrap/bootstrap.min.js' )  }}"></script>
    <script src="{{ asset( 'assets/js/main.js' )  }}"></script>
</body>
</html>