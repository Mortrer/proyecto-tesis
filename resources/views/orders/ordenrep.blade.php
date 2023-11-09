@extends('layout.layoutgeneral')

@section('titulo', 'Reparación')

@section('cuerpo')
    <div class="container  py-4 col-12 pt-5">
        <div class="card">
            <div class="card-body">
                <table class="table table-light table-striped" id="rep" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No. Orden</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Equipo</th>
                            <th scope="col">Fecha estimada</th>
                            <th scope="col">Estado Costo</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordenes as $orden)
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

                                <td scope="row"> <a class="btn btn-outline-primary"
                                        href="{{ route('order.repord', $orden->norden) }}"><i
                                            class="bi bi-pencil-square"></i> Reparar</a></td>
                            </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />
    <script type="text/javascript" src="/DataTables/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#rep').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ Registros por página",
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(Filtrado de _MAX_ Registros totales)",
                    "search": "Buscar: ",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>

@endsection
