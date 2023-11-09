@extends('layout.layoutgeneral')

@section('titulo', 'Ordenes de Trabajo')

@section('cuerpo')
    <div class="container py-4 col-15 pt-5">
        <div class="card">
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
                            <th scope="col">Opciones</th>
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
                                @can('order.show')
                                    <td scope="row"><a class="btn btn-outline-primary"
                                            href="{{ route('order.show', $orden->norden) }}"><i class="bi bi-pencil-square"></i>
                                            Ver</a></td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
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
            $('#orden').DataTable({
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
