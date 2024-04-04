
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DXX Memories</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>memory's dx</title>
</head>

    <body style="background-color: #F8F6E3">
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #7AA2E3">
                <div class="container-fluid">
                  <a class="navbar-brand" href="/albums">DX Memory's gallery ♈|</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/albums"> My Albums</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/likedphoto"> favorite photo</a>
                      </li>
                      {{-- <li class="nav-item">
                        <a class="nav-link" href="/albums/create">make new Album</a>
                      </li> --}}
                    </ul>
                  </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <button class="btn btn-primary" style="background-color: #7AA2E3" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </button>
                        </li>
                    </ul>
                </div>
              </nav>

            <main class="py-4" >
            <div class="container">
                @include('inc.messages')
                @yield('content')
            </div>
            </main>
        </div>
</body>
</html>
