@extends('layout.layoutgeneral')

@section('cuerpo')
    @can('order.index')
        <div class="container py-4 col-8 pt-4">
            <div id="myCarousel" class="carousel slide pt-4">
                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
                </ol>

                <!-- Contenido del carrusel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <!-- Contenido de la primera diapositiva -->
                        <div class="card pt-4">
                            <div class="card-header text-center bg-primary text-white">
                                <h4>Consulta de Ordenes</h4>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="container text-center">
                                    <a href="{{ route('order.index') }}" class="btn btn-outline-primary"><i
                                            class="bi bi-search"></i> Ver
                                        ordenes</a>
                                </div>
                                <table class="table table-light table-striped" id="orden" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. Orden</th>
                                            <th scope="col">Equipo</th>
                                            <th scope="col">Fecha estimada</th>
                                            {{-- <th scope="col">Técnico</th> --}}
                                            <th scope="col">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ordenes as $orden)
                                            <tr>
                                                <td scope="row" id="orden">{{ $orden->norden }}</td>
                                                <td scope="row" id="serial">{{ $orden->marca }} {{ $orden->modelo }}</td>
                                                <td scope="row" id="fecha">{{ $orden->fecha_estimada }}</td>
                                                <td scope="row" id="estado">{{ $orden->estado }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <!-- Contenido de la segunda diapositiva -->
                        <div class="container  py-4 col-12 pt-1">
                            <div class="card pt-4">
                                <div class="card-header text-center bg-primary text-white">
                                    <h4>Ordenes Asignadas</h4>
                                    <hr>

                                </div>
                                <div class="card-body">
                                    <div class="container text-center">
                                        <a href="{{ route('order.rep') }}" class="btn btn-outline-primary"><i
                                                class="bi bi-wrench"></i> Ver ordenes
                                            a reparar</a>
                                    </div>
                                    <table class="table table-light table-striped" id="rep" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">No. Orden</th>
                                                <th scope="col">Equipo</th>
                                                <th scope="col">Fecha estimada</th>
                                                <th scope="col">Estado Costo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ordenrep as $orden)
                                                <tr>
                                                    <td scope="row" id="orden">{{ $orden->norden }}</td>
                                                    <td scope="row" id="serial">{{ $orden->marca }} -
                                                        {{ $orden->modelo }}</td>
                                                    <td scope="row" id="fecha">{{ $orden->fecha_estimada }}</td>
                                                    @switch($orden->costEstado)
                                                        @case('Aceptado')
                                                            <td scope="row">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="dot dot-activo"></div>
                                                                </div>
                                                            </td>
                                                        @break

                                                        @case('Rechazado')
                                                            <td scope="row">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="dot dot-inactivo"></div>
                                                                </div>
                                                            </td>
                                                        @break

                                                        @case('En espera de confirmación')
                                                            <td scope="row">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="dot dot-ausente"></div>
                                                                </div>
                                                            </td>
                                                        @break

                                                        @default
                                                            <td scope="row">

                                                                <div class="d-flex align-items-center">
                                                                    <div class="dot dot-gris"></div>
                                                                </div>
                                                            </td>
                                                    @endswitch
                                                </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controles del carrusel -->
                <a class="carousel-control-prev top-0" href="#myCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </a>
                <a class="carousel-control-next top-0" href="#myCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </a>
            </div>
            {{-- <div class="card">
                <div class="card-header text-center">
                    <h4>Consulta de Ordenes</h4>
                    <hr>
                    <a href="{{ route('order.index') }}" class="btn btn-outline-primary"><i class="bi bi-search"></i> Ver
                        ordenes</a>
                </div>
                <div class="card-body">
                    <table class="table table-light table-striped" id="orden" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No. Orden</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">Fecha estimada</th>
                                <th scope="col">Técnico</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ordenes as $orden)
                                <tr>
                                    <td scope="row" id="orden">{{ $orden->norden }}</td>
                                    <td scope="row" id="cliente">{{ $orden->nombre }} {{ $orden->apellidos }}</td>
                                    <td scope="row" id="serial">{{ $orden->marca }} {{ $orden->modelo }}</td>
                                    <td scope="row" id="fecha">{{ $orden->fecha_estimada }}</td>
                                    @if ($orden->unombre || $orden->apellido)
                                        <td scope="row" id="comentario">{{ $orden->unombre }} {{ $orden->apellido }}</td>
                                    @else
                                        <td scope="row" id="comentario"> No Asignado</td>
                                    @endif
                                    <td scope="row" id="estado">{{ $orden->estado }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    @endcan
    <hr>
    {{-- @can('order.rep')
        <div class="container  py-4 col-12 pt-1">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Ordenes por reparar asignadas</h4>
                    <hr>
                    <a href="{{ route('order.rep') }}" class="btn btn-outline-primary"><i class="bi bi-wrench"></i> Ver ordenes
                        a reparar</a>
                </div>
                <div class="card-body">
                    <table class="table table-light table-striped" id="rep" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No. Orden</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">Fecha estimada</th>
                                <th scope="col">Estado Costo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ordenrep as $orden)
                                <tr>
                                    <td scope="row" id="orden">{{ $orden->norden }}</td>
                                    <td scope="row" id="cliente">{{ $orden->nombre }} {{ $orden->apellidos }}</td>
                                    <td scope="row" id="serial">{{ $orden->marca }} - {{ $orden->modelo }}</td>
                                    <td scope="row" id="fecha">{{ $orden->fecha_estimada }}</td>
                                    @switch($orden->costEstado)
                                        @case('Aceptado')
                                            <td scope="row">
                                                <div class="d-flex align-items-center">
                                                    <div class="dot dot-activo"></div>
                                                </div>
                                            </td>
                                        @break

                                        @case('Rechazado')
                                            <td scope="row">
                                                <div class="d-flex align-items-center">
                                                    <div class="dot dot-inactivo"></div>
                                                </div>
                                            </td>
                                        @break

                                        @case('En espera de confirmación')
                                            <td scope="row">
                                                <div class="d-flex align-items-center">
                                                    <div class="dot dot-ausente"></div>
                                                </div>
                                            </td>
                                        @break

                                        @default
                                            <td scope="row">

                                                <div class="d-flex align-items-center">
                                                    <div class="dot dot-gris"></div>
                                                </div>
                                            </td>
                                    @endswitch
                                </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endcan --}}
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />

    <script type="text/javascript" src="/DataTables/datatables.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#orden').DataTable({
                "language": {
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(Filtrado de _MAX_ Registros totales)"
                },
                "lengthMenu": [
                    [10],
                    [10]
                ], // Muestra 10 registros por página y desactiva el cambio
                "paging": true, // Habilita la paginación
                "searching": false, // Elimina la opción de búsqueda
            });
        });


        $(document).ready(function() {
            $('#rep').DataTable({
                "language": {
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(Filtrado de _MAX_ Registros totales)"
                },
                "lengthMenu": [
                    [10],
                    [10]
                ], // Muestra 10 registros por página y desactiva el cambio
                "paging": true, // Habilita la paginación
                "searching": false, // Elimina la opción de búsqueda
            });
        });
    </script>
@endsection
