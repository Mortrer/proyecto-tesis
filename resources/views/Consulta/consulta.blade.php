@extends('layout.layoutpage')
<link rel="stylesheet" href="{{ asset('css/stepbar.css') }}">

@section('titulo', 'Consulta O.T')

@section('cuerpo')
    <div class="container col-10 pt-5">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('consult') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="cons" class="form-control"
                            placeholder="Ingresar Número Orden de Trabajo" id="bsc" value="{{ old('cons') }}">
                        <button class="btn btn-outline-dark" id="buscar">Búsqueda</button>
                    </div>
                </form>
                <div class="container">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
            @if (session()->has('query'))
                <!-- MultiStep Form -->
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-offset-3">
                            <form id="msform" method="POST"
                                action="{{ route('costo.presupuesto', session('query')->norden) }}">
                                @csrf
                                @if (session('estado') == '1')
                                    <div class="card m-auto col-7">
                                        <div class="card-header">

                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active">Información Personal</li>
                                                <li>Información General</li>
                                                <li>Presupuesto</li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <!-- fieldsets -->

                                            <h2 class="fs-title">Información Personal</h2>
                                            <h3 class="fs-subtitle">Cliente y dispositivo</h3>
                                            <div class="input-group mb-1">
                                                <label for="nombre_apellidos"
                                                    class="input-group-text col-5 fw-bolder">Nombre y
                                                    apellido</label>
                                                <span class="form-control">{{ session('query')->nombre }}
                                                    {{ session('query')->apellidos }}</span>
                                            </div>
                                            <div class="input-group mb-1">
                                                <label for="" class="input-group-text fw-bolder">Marca</label>
                                                <span class="form-control"> {{ session('query')->marca }}</span>
                                                <label for="" class="input-group-text fw-bolder">Modelo</label>
                                                <span class="form-control"> {{ session('query')->modelo }}</span>
                                            </div>

                                            {{-- <input type="button" name="next" class="next action-button" value="Next" /> --}}


                                        </div>
                                        <div class="card-footer">
                                            <div class="container pt-3">
                                                <a class="next action-button"
                                                    href="{{ route('estado.visita', ['id' => session('query')->norden, 'estado' => 2]) }}">Continuar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (session('estado') == '2')
                                    <div class="card m-auto col-7">
                                        <div class="card-header">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active">Información Personal</li>
                                                <li class="active">Información General</li>
                                                <li>Presupuesto</li>
                                            </ul>
                                        </div>
                                        <div class="card-body">

                                            <h2 class="fs-title">Información General</h2>
                                            <h3 class="fs-subtitle">Orden de Trabajo</h3>
                                            <div class="input-group mb-1">
                                                <label for="orden" class="input-group-text col-5 fw-bolder">No.
                                                    Orden</label>
                                                <span class="form-control"> {{ session('query')->norden }}</span>
                                            </div>
                                            <div class="input-group mb-1">
                                                <label for="" class="input-group-text col-5 fw-bolder">Estado de
                                                    la
                                                    Orden</label>
                                                <span class="form-control">{{ session('query')->estado }}</span>
                                            </div>
                                            <div class="input-group mb-1">
                                                <label for="E_Fisico" class="input-group-text col-12 fw-bolder">Estado
                                                    físico
                                                    del equipo</label>
                                                <textarea class="form-control" aria-label="With textarea" name="problema" readonly>{{ session('query')->h_detalles }}</textarea>
                                            </div>
                                            <div class="input-group mb-1">
                                                <label for="Problema"
                                                    class="input-group-text col-12 fw-bolder">Problema</label>
                                                <textarea class="form-control" aria-label="With textarea" name="problema" readonly>{{ session('query')->comentarios }}</textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">

                                            <a class="previous action-button-previous"
                                                href="{{ route('estado.visita', ['id' => session('query')->norden, 'estado' => 1]) }}">Regresar</a>

                                            <a class="next action-button"
                                                href="{{ route('estado.visita', ['id' => session('query')->norden, 'estado' => 3]) }}">Continuar</a>

                                        </div>
                                    </div>
                                @endif
                                @if (session('estado') == '3')
                                    <div class="card m-auto col-9">
                                        <div class="card-header">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active">Información Personal</li>
                                                <li class="active">Información General</li>
                                                <li class="active">Presupuesto</li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            {{-- <fieldset > --}}
                                            <h2 class="fs-title">Presupuesto para Reparación</h2>
                                            <h3 class="fs-subtitle">Listado y costo final</h3>
                                            @if (session('presu'))
                                                <table class="table table-light table-striped table-responsive"
                                                    id="user">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No.</th>
                                                            <th scope="col">Detalle</th>
                                                            <th scope="col">Precio</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (session('presu') as $key => $budget)
                                                            <tr>
                                                                <td scope="row">{{ $key + 1 }}</td>
                                                                <td scope="row">{{ $budget->detalle }}</td>
                                                                <td scope="row">{{ $budget->costo }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="container text-center">
                                                    <div class="form-check">
                                                        <label class="form-check-label fw-bolder"
                                                            for="flexRadioDefault2">Aceptar</label>
                                                        <input class="form-check-input" type="radio" name="reparacion"
                                                            value="Aceptado" id="Aceptar">

                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label fw-bolder"
                                                            for="flexRadioDefault2">Rechazar</label>
                                                        <input class="form-check-input" type="radio" name="reparacion"
                                                            value="Rechazado" id="Rechazar">
                                                    </div>
                                                    @if (session()->has('error'))
                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            <strong for="">{{ session('error') }}</strong>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @endif


                                                    <div class="input-group mb-1">
                                                        <label for="comentario"
                                                            class="input-group-text fw-bolder">Comentarios</label>
                                                        @if (session('query')->comentario)
                                                            <textarea class="form-control disabled" aria-label="With textarea" name="comentario" readonly>{{ session('query')->comentario }}</textarea>
                                                        @else
                                                            <textarea class="form-control" aria-label="With textarea" name="comentario"></textarea>
                                                        @endif
                                                    </div>

                                                </div>
                                            @else
                                                <div class="input-group mb-1">
                                                    <span class="form-control"> Aún no hay un Presupuesto Generado.</span>
                                                </div>
                                            @endif
                                            {{-- </fieldset> --}}
                                        </div>
                                        <card-footer>
                                            <a class="previous action-button-previous"
                                                href="{{ route('estado.visita', ['id' => session('query')->norden, 'estado' => 2]) }}">Regresar</a>
                                            @if (session('presu'))
                                                @if (session('query')->costEstado == 'En espera de confirmación')
                                                    <button class="btn action-button ">Aceptar</button>
                                                @else
                                                @endif
                                                {{-- @if (session('query')->costEstado == 'Aceptar' || session(('query')->costEstado == 'Rechazar'))
                                                    
                                                    @else
                                                        
                                                @endif --}}
                                            @endif
                                        </card-footer>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <!-- /.MultiStep Form -->
                </div>
            @else
                <div class="contenedor textcenter" id="noansw">
                    <h3>Ingrese el numero de orden</h3>
                </div>
            @endif

        </div>
    </div>



@endsection


@section('script')
    <script></script>
@endsection
