@extends('layout.layoutec')

@section('titulot', 'ordenes')


@section('cuerpot')
    <div class="container">
        <h4 class="py-4 text-center">Ordenes de trabajo</h4>
        <div class="container py-4 col-10">
            <div class="input-group py-4">
                <span class="input-group-text col-1">Busqueda</span>
                <input type="text" name="norden" id="norden" class="form-control" placeholder="No. Orden">
                <a href="" class="btn btn-primary">Buscar</a>
            </div>
        </div>
        <div class="container d-flex justify-content-center py-4">
            <div class="table-responsive col-10">
                <table class="table table-dark table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">No. orden</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Equipo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <th scope="row">2</th>
                            <th scope="row">3</th>
                            <th scope="row">4</th>
                            <th scope="row"><a href="" class="btn btn-primary"> Editar</a></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
