<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Breadcrumbs::pageTitle() }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary border-bottom shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>  {{ __('auth.signin.title') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('auth.signup.title') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->managing->isNotEmpty())<a class="dropdown-item" href="{{ route('c-index') }}"><i class="fas fa-user-secret"></i> {{ __('Admin Panel') }}</a>@endif
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logg ut') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            {{ Breadcrumbs::render() }}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            @yield('content')
        </div>
    </main>
    <footer class="footer mt-auto py-3 text-light bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p>&copy; {{ \Carbon\Carbon::now()->year }} Infihex &middot; <i class="fas fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s</small></p>
                    <div class="dropup btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fas fa-language"></i> {{ mb_strtoupper(App::getLocale()) }}<span class="caret"></span></button>
                        <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                            @foreach(array_flip(config('app.locales')) as $language => $lang)
                                <a class="dropdown-item" href="{{ route('locale', $lang) }}">{{ $language }}</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-6 text-right">
            <p>
                        <a href="javascript:;" onclick="$('#changelog').modal('show', {backdrop: 'static'})" class="text-white">{{ Setting::get('APP_VERSION') }}</a> &middot; {!! __('footer.developedwith') !!} <a href="https://infihex.com/" target="_blank" class="text-info">Infihex</a>
                @if(Config::get('app.debug'))
                    <p>
                                <b><span class="text-danger">{{ mb_strtoupper(__('footer.debugmode')) }}</span></b>
                                @if(Setting::get('APP_SHOW_RESETDB'))
                                    <b>&middot; <a href="/resetdb" class="text-danger">{{ mb_strtoupper(__('footer.resetdbandsettings')) }}</a></b>
                                @endif
                    </p>
                @endif
            </p>
        </div>
            </div>
        </div>
    </footer>

    @yield('javascript')

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#237afc"
            },
            "button": {
              "background": "#fff",
              "text": "#237afc"
            }
          },
          "theme": "classic",
          "position": "bottom-right",
          "content": {
            "message": "{{ __('global.cookie.message') }}",
            "dismiss": "{{ __('global.cookie.dissmiss') }}",
            "link": "{{ __('global.cookie.link') }}",
            "href": "{{ url('/privacy') }}"
          }
        });
    </script>

</body>
</html>
