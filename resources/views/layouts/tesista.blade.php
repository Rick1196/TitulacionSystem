@include('layouts.header')
<style>
    .list-group{
    max-height: 300px;
    margin-bottom: 10px;
    overflow:scroll;
    -webkit-overflow-scrolling: touch;
    }
</style>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand" href="#">
            <img src="{{asset('images/logo_bg.png')}}" height="50" alt="UAEMex">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/tesista">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Seguimiento
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('protocolos.listar',Auth::user()->id)}}">Listar misprotocolos</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                @if(!Auth::user()->hasRegisters(Auth::user()->id))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Registrar un protocolo
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/tesista/articulo">Artículo</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tesista/ensayo">Ensayo</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tesista/exp_lab">Memoria de Experiencia Laboral</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tesista/app_con">Reporte de Aplicación de conocimiento</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tesista/rep_aut">Reporte de Autoempleo</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tesista/rep_res">Reporte de Residencia de Investigación</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tesista/tesina">Tesina</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tesista/tesis">Tesis</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                @endif
            </ul>
            <ul class="navbar-nav">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Salir') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            </ul>
        </div>
    </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
