@extends('layout.layoutrep')

@section('titulor', 'Ordenes')

@section('cuerpor')
    <div class="container">
        <h4 class="py-4 text-center">Ordenes de trabajo</h4>
        <div class="container text-center">
            <a href="{{route ('cliente.index')}}" class="btn btn-outline-dark">Generar Orden</a>
            <a href="" class="btn btn-outline-dark">Asignar Orden</a>
        </div>
        <div class="container py-4 col-10">
            <div class="input-group py-4">
                <span class="input-group-text col-1">Busqueda</span>
                
                <input type="text" name="norden" id="norden" class="form-control" placeholder="No. Orden">
                <a href="" class="btn btn-outline-dark">Buscar</a>
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
                            <th scope="col">Técnico</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    @foreach ($ordenes as $orden)    
                    <tbody>
                        <tr>
                            <th scope="row">{{$orden->norden}}</th>
                            <th scope="row">{{$orden->id_cliente}}</th>
                            <th scope="row">{{$orden->id_equipo}}</th>
                            <th scope="row">{{$orden->estado}}</th>
                            <th scope="row">{{$orden->id_user}}</th>
                            <th scope="row"><a href="" class="btn btn-outline-light">Asignación</a></th>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
