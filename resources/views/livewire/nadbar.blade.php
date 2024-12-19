<div>
    <header class="fixed-top border-bottom border-success">

        @if (!$user)
            <nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
                <div class="container-fluid">

                    <button class="navbar-toggler my-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <img src="{{ asset('img/logo-megaSoftt-removebg-preview.png') }}" alt="Logo"
                                        width="30" height="24" class="d-inline-block align-text-top">
                                    <span class="text-success"><b>Mega Soft</b></span>
                                </a>
                            </li>
                        </ul>
                        <a class="btn btn-outline-success me-2" href="{{ route('login') }}">Inicia Sesión</a>
                        <a class="btn btn-success" href="{{ route('register') }}">Registrate</a>

                    </div>
                </div>
            </nav>
        @endif

        @if ($user)
            <nav class="navbar navbar-expand-lg bg-body-tertiary p-2 justify-content-between">
                <div class="d-flex mb-2">
                    <a class="btn btn-outline-success me-2" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebar" aria-controls="staticBackdrop">
                        &#9776
                    </a>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown"
                        data-bs-display="static" aria-expanded="false">
                        Bienvenido {{ $user->user_name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start border border-success">
                        <li>
                            <a class="dropdown-item" type="button" href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li>
                            <a class="dropdown-item" type="button"
                                href="{{ route('dashboard', ['vista' => 'profile']) }}">
                                Dashboard
                            </a>
                        </li>

                        <form action="{{ route('logout.index') }}" method="POST">
                            @csrf
                            <li><button class="dropdown-item" type="submit">Cerrar Sesión</button></li>
                        </form>

                    </ul>
                </div>
            </nav>
        @endif

    </header>

</div>
