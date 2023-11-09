@extends('layout.layoutgeneral')

@section('titulo', 'Usuarios')

@section('cuerpo')
    <div class="container py-4 col-10 pt-5">
        <div class="card">
            <div class="card-body">
                <table class="table table-light table-striped" id="user">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td scope="row">{{ $usuario->usuario }}</td>
                                <td scope="row">{{ $usuario->unombre }}</td>
                                <td scope="row">{{ $usuario->apellido }}</td>
                                @can('admin.user.show')
                                    <td scope="row"><a href="{{ route('user.show', $usuario->id) }}"
                                            class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i> Ver</a>
                                    </td>
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
            $('#user').DataTable({

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
