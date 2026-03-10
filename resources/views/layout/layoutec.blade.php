<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ mix('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/navside.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ed08497922.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
    <script language="javascript" type="text/javascript">
        function limitText(limitField, limitNum) {
            function maxLengthCheck(object) {
                if (object.value.length > object.maxLength)
                    object.value = object.value.slice(0, object.maxLength)
            }
        }
    </script>
    <!--fin script -->
    <title>@yield('titulo')</title>
</head>

<body>
    <div class="main-container d-flex">


        <div class="content pl-10 ">
            <div id="app" class="pb-3">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <a class="type btn btn-dark" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    </div>
                                @else
                                    <a href="" class="btn btn-dark">Usuario: {{ auth()->user()->usuario }} ID:
                                        {{ auth()->user()->id }}</a>
                                    <a class="type btn btn-dark" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    </div>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="sidebar" id="side_nav">
                    <div class="header-box px-2 pt-3 pb-4">
                        <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">STRT</span><span
                                class="text-white">System Tools</span>
                        </h1>
                        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                                class="fal fa-stream"></i></button>
                    </div>
                    {{-- yield para los usuarios --}}
                    <ul class="list-unstyled px-2">
                        @can('admin.user.index')
                            <li onClick="toggleActive(this)"><a href="{{ route('user.index') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-person"></i> Usuarios</a>
                            </li>
                            <li onClick="toggleActive(this)"><a href="{{ route('user.create') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-person-add"></i> Nuevo
                                    Usuario</a></li>
                            <li onClick="toggleActive(this)"><a href="{{ route('role.index') }} "
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-person-rolodex"></i>
                                    Roles</a></li>
                        @endcan
                    </ul>
                    <hr class="h-color mx-2">

                    {{-- yield para ordenes --}}
                    <ul class="list-unstyled px-2">
                        @can('order.index')
                            <li onClick="toggleActive(this)"><a href="{{ route('order.index') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i
                                        class="bi bi-file-earmark-text-fill"></i> O.T Consulta</a></li>
                        @endcan

                        @can('order.rep')
                            <li onClick="toggleActive(this)"><a href="{{ route('order.rep') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i
                                        class="bi bi-file-earmark-text-fill"></i> O.T Reparación</a></li>
                        @endcan

                        @can('order.cliente.create')
                            <li onClick="toggleActive(this)"><a href="{{ route('cliente.create') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i
                                        class="bi bi-file-earmark-plus-fill"></i> Nueva Orden</a></li>
                        @endcan
                        @can('order.asig')
                            <li onClick="toggleActive(this)"><a href="{{ route('order.asig') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-wrench"></i> Asignación a
                                    Técnico</a></li>
                        @endcan
                        @can('order.costo.index')
                            <li onClick="toggleActive(this)"><a href="{{ route('costo.index') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-cash-stack"></i> Costo y
                                    Presupuesto</a></li>
                        @endcan
                    </ul>
                    <hr class="h-color mx-2">
                </div>
                <div class="contenido">
                    @yield('cuerpo')

                </div>

            </div>
        </div>
    </div>
    @yield('script')
    <script>
        function toggleActive(element) {
            // Agrega la clase 'active' al elemento seleccionado
            element.classList.add('active');

            // Recorre todos los elementos li y elimina la clase 'active' en los que no sean el elemento seleccionado
            var liElements = document.getElementsByTagName('li');
            for (var i = 0; i < liElements.length; i++) {
                if (liElements[i] !== element) {
                    liElements[i].classList.remove('active');
                }
            }
        }
    </script>
</body>

</html>
