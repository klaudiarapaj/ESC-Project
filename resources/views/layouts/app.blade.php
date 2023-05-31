<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ESC') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.png') }}">
  
   


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
   

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('storage/logo/logo.png') }}" style="width:50px" alt="Logo">
        </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @auth
                <form action="{{ route('search') }}" method="GET">
                    <div class="d-flex ms-auto">
                        <input class="form-control me-2" type="text" class="form-control" placeholder="Search" name="query">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>

                <!-- Middle of Navbar -->

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications.index') }}">
                        <i class="fas fa-bell"></i> Notifications
                        </a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bookmarks') }}">
                        <i class="fas fa-bookmark"></i> Bookmarks
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feedback') }}">
                        <i class="fas fa-comment"></i> Feedback
                        </a>
                </ul>
                @endauth
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        @auth
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>

                            @if (Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{ route('admin.index') }}">Admin</a>
                            @endif

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Log in') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endauth
                </ul>
            </div>

        </nav>

        <main class="py-4">
            @yield('content')
        </main>
  

        @if (Route::is('home'))
        <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p><b>&copy; <?php echo date('Y'); ?> Klaudia Rapaj. All rights reserved.</b></p>
                </div>
                <div class="col-md-6">
                    <ul class="footer-links">
                      
                        <li><a href="https://www.epoka.edu.al/home.html">Epoka University</a></li>
                        <li> <a href="https://epoka.edu.al/home-visitors-policies-9-5.html">Policies</a></li>
                        <li><a href="mailto:krapaj20@epoka.edu.al">Contact Us</a></li>
                      
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    @endif

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    


</body>

</html>

<style>
    
/* Footer Styles *//* Sticky Footer Styles */
html, body {
    height: 100%;
}

.wrapper {
    min-height: 100%;
    display: flex;
    flex-direction: column;
}

.push {
    flex-grow: 1;
}

/* Footer Styles */
.footer {
    background-color: #f8f8f8;
    padding: 20px 0;
    color: #555;
}

.footer p,
.footer a {
    margin: 0;
    padding: 0;
    color: #555;
}

.footer-links li {
    display: inline;
    margin-right: 10px;
}

.footer-links a {
    text-decoration: none;
    color: #555;
}

/* Optional: Additional styling to enhance the footer appearance */
.footer {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container {
    max-width: 960px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
}

</style>
