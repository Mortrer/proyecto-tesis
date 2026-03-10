@extends('layout.layoutgeneral')

@section('titulo', 'Costos')

@section('cuerpo')
    <div class="container py-4 col-10 pt-5">
        <div class="card">
            <div class="card-body">
                <table class="table table-light table-striped" id="costos" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No. Orden</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acción</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($costo as $cost)
                            <tr>
                                <td scope="row" id="orden">{{ $cost->id_orden }}</td>
                                <td scope="row" id="cliente">Q. {{ $cost->precio }}</td>
                                <td scope="row" id="serial">{{ $cost->estado }}</td>
                                <td scope="row"><a class="btn btn-outline-primary" href="{{ route('costo.show', $cost->id_orden) }}"><i class="fa-solid fa-pen-to-square"></i> Ver</a></td>
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
            $('#costos').DataTable({
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
