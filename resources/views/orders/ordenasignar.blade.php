@extends('layout.layoutgeneral')

@section('titulo', 'Asignación')



@section('cuerpo')
    <div class="container py-4 col-10 pt-5">
        <div class="container pt-5">
            @if (session('info'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('info') }}.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <table class="table table-light table-striped" id="asignar">
            <thead>
                <tr>
                    <th scope="col">No. Orden</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Fecha estimada</th>
                    {{-- <th scope="col">Técnico</th> --}}
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordenes as $orden)
                    <tr>
                        <td scope="row" id="orden">{{ $orden->norden }}</td>
                        <td scope="row" id="cliente">{{ $orden->nombre }} {{ $orden->apellidos }}</td>
                        <td scope="row" id="serial">{{ $orden->marca }} {{ $orden->modelo }}</td>
                        <td scope="row" id="fecha">{{ $orden->fecha_estimada }}</td>
                        @can('order.asig')
                            <td scope="row"><a class="btn btn-outline-primary"
                                    href="{{ route('order.asignar', $orden->norden) }}"><i
                                        class="bi bi-clipboard-check-fill"></i> Asignar</a></td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />

    <script type="text/javascript" src="/DataTables/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#asignar').DataTable({
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
