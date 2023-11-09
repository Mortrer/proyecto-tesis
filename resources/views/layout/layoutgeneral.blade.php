<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ mix('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/navside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dot.css') }}" rel="stylesheet">
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
                <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
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
                                    <div class="form-group">
                                        <div class="input-group position-relative">
                                            <label for="user" class=" input-group-text">Usuario: </label>
                                            <span class="form-control"> {{ auth()->user()->usuario }}</span>
                                            <a class="type btn btn-primary text-white" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </div>
                                    </div>
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
                    {{-- <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">SysTS</span><span --}}
                    <div class="header-box px-2 pt-3 pb-4 text-center">
                        <img src="/Images/ServiceLog_final.png" alt="Logo de la app" class="w-50 h-15 mx-auto d-block">
                        <hr class="h-color mx-2">
                        <div class="mt-2">
                            <h3 class="mt-3">
                                <div class="container text-center bg-primary pt-3 pb-3">
                                    <span class="text-white fs-3">ServiceLog</span>
                                </div>
                            </h3>
                        </div>
                        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                                class="fal fa-stream"></i></button>
                        <hr class="h-color mx-2">
                    </div>
                    {{-- yield para los usuarios --}}
                    <ul class="list-unstyled px-2">
                        @can('admin.user.index')
                            @php
                                $activeUserIndex = '';
                                $activeUserCreate = '';
                                $activeRoleIndex = '';
                                $activeHomeIndex = '';
                            @endphp
                            @if (request()->routeIs('home'))
                                @php
                                    $activeHomeIndex = 'active';
                                @endphp
                            @endif
                            @if (request()->routeIs('user.index') || request()->routeIs('user.show'))
                                @php
                                    $activeUserIndex = 'active';
                                @endphp
                            @endif
                            @if (request()->routeIs('user.create'))
                                @php
                                    $activeUserCreate = 'active';
                                @endphp
                            @endif
                            @if (request()->routeIs('role.index') || request()->routeIs('role.create') || request()->routeIs('role.show'))
                                @php
                                    $activeRoleIndex = 'active';
                                @endphp
                            @endif
                            <li class="{{ $activeHomeIndex }}"><a href="{{ route('home') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-house"></i> Home</a></li>
                            <li class="{{ $activeUserIndex }}"><a href="{{ route('user.index') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-person"></i> Usuarios</a>
                            </li>
                            <li class="{{ $activeUserCreate }}"><a href="{{ route('user.create') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-person-add"></i> Nuevo
                                    Usuario</a></li>
                            <li class="{{ $activeRoleIndex }}"><a href="{{ route('role.index') }} "
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-person-rolodex"></i>
                                    Roles</a></li>
                        @endcan
                    </ul>
                    <hr class="h-color mx-2">

                    {{-- yield para ordenes --}}
                    <ul class="list-unstyled px-2">
                        @php
                            $activeOrderIndex = '';
                            $activeOrderRep = '';
                            $activeOrderCreate = '';
                            $activeOrderAsig = '';
                            $activeCostoIndex = '';
                        @endphp

                        @if (request()->routeIs('order.index') || request()->routeIs('order.show') || request()->routeIs('order.update'))
                            @php
                                $activeOrderIndex = 'active';
                            @endphp
                        @endif
                        @if (request()->routeIs('order.rep') || request()->routeIs('order.repord') || request()->routeIs('budget.create'))
                            @php
                                $activeOrderRep = 'active';
                            @endphp
                        @endif
                        @if (request()->routeIs('cliente.create') || request()->routeIs('order.hardware') || request()->routeIs('order.create'))
                            @php
                                $activeOrderCreate = 'active';
                            @endphp
                        @endif
                        @if (request()->routeIs('order.asig') || request()->routeIs('order.asignar'))
                            @php
                                $activeOrderAsig = 'active';
                            @endphp
                        @endif
                        @if (request()->routeIs('costo.index') || request()->routeIs('costo.show'))
                            @php
                                $activeCostoIndex = 'active';
                            @endphp
                        @endif

                        @can('order.cliente.create')
                            <li class="{{ $activeOrderCreate }}"><a href="{{ route('cliente.create') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i
                                        class="bi bi-file-earmark-plus-fill"></i> Nueva Orden</a></li>
                        @endcan

                        @can('order.asig')
                            <li class="{{ $activeOrderAsig }}"><a href="{{ route('order.asig') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-wrench"></i> Asignación
                                    a
                                    Técnico</a></li>
                        @endcan

                        @can('order.rep')
                            <li class="{{ $activeOrderRep }}"><a href="{{ route('order.rep') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i
                                        class="bi bi-file-earmark-text-fill"></i> O.T Reparación</a></li>
                        @endcan

                        @can('order.index')
                            <li class="{{ $activeOrderIndex }}"><a href="{{ route('order.index') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i
                                        class="bi bi-file-earmark-text-fill"></i> O.T Consulta</a></li>
                        @endcan


                        @can('order.costo.index')
                            <li class="{{ $activeCostoIndex }}"><a href="{{ route('costo.index') }}"
                                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-cash-stack"></i> Costo
                                    y
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
</body>

</html>
