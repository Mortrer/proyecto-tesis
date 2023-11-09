@extends('layout.layoutgeneral')

@section('titulo', 'Reparar')

@section('cuerpo')
    <div class="container">
        <a href="{{ route('user.index') }}" class="btn btn-primary">Regresar</a>
        <h4 class="py-4 text-center">Ordenes asignadas</h4>
        <div class="container d-flex justify-content-center ">
            <div class="table-responsive col-6">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No. orden</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Equipo</th>
                            <th scope="col">Serial</th>
                            <th scope="col">comentarios</th>
                            <th scope="col">acciones</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <th scope="row">2</th>
                                <th scope="row">3</th>
                                <th scope="row">4</th>
                                <th><a href="#" type="" class="btn btn-primary">Editar</a></th>
                            </tr>
                        </tbody>
                
                </table>
            </div>
        </div>
    </div>
@endsection
