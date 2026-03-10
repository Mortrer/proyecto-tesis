@extends('layout.layoutgeneral')


@section('titulo', 'Roles')


@section('cuerpo')
    <div class="container col-8">
        <div class="card">
            <div class="card-header">
                <div class="container text-center pt-5 pb-5">
                    <a href="{{ route('role.create') }}" class="btn btn-outline-primary"><i class="bi bi-person-rolodex"></i>
                        Crear nuevo Rol</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-light table-striped" id="rol">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acción 1</th>
                            <th scope="col">Acción 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rols as $key => $rol)
                            <tr>
                                <td scope="row" class="col-1">{{ $key + 1 }}</td>
                                <td scope="row">{{ $rol->name }}</td>
                                @can('role.show')
                                    <td scope="row"><a href="{{ route('role.show', $rol->id) }}"
                                            class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i> Editar</a></td>
                                @endcan
                                @can('role.delete')
                                    <td scope="row">
                                        <a href="{{ route('role.delete', $rol->id) }}" class="btn btn-outline-primary"><i
                                                class="bi bi-trash"></i>Eliminar</a>
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
            $('#rol').DataTable({
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
