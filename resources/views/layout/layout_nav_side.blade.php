<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
    </div>
    {{-- yield para los usuarios --}}
    <ul class="list-unstyled px-2">
        @can('admin.user.index')
            @php
                $activeUserIndex = '';
                $activeUserCreate = '';
                $activeRoleIndex = '';
            @endphp
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
            @if (request()->routeIs('role.index') || request()->routeIs('role.create'))
                @php
                    $activeRoleIndex = 'active';
                @endphp
            @endif
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
        @if (request()->routeIs('order.asig'))
            @php
                $activeOrderAsig = 'active';
            @endphp
        @endif
        @if (request()->routeIs('costo.index'))
            @php
                $activeCostoIndex = 'active';
            @endphp
        @endif

        @can('order.index')
            <li class="{{ $activeOrderIndex }}"><a href="{{ route('order.index') }}"
                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-file-earmark-text-fill"></i> O.T
                    Consulta</a></li>
        @endcan

        @can('order.rep')
            <li class="{{ $activeOrderRep }}"><a href="{{ route('order.rep') }}"
                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-file-earmark-text-fill"></i> O.T
                    Reparación</a></li>
        @endcan

        @can('order.cliente.create')
            <li class="{{ $activeOrderCreate }}"><a href="{{ route('cliente.create') }}"
                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-file-earmark-plus-fill"></i> Nueva
                    Orden</a></li>
        @endcan
        @can('order.asig')
            <li class="{{ $activeOrderAsig }}"><a href="{{ route('order.asig') }}"
                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-wrench"></i> Asignación a
                    Técnico</a></li>
        @endcan
        @can('order.costo.index')
            <li class="{{ $activeCostoIndex }}"><a href="{{ route('costo.index') }}"
                    class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-cash-stack"></i> Costo y
                    Presupuesto</a></li>
        @endcan
    </ul>
    <hr class="h-color mx-2">
</div>
