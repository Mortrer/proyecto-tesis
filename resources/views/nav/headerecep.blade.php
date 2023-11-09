<div class="containers">
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="badge bg-light text-dark">{{-- {{$rol}} --}}</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('servicio_tecnico') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.index') }}">Ordenes</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</div>