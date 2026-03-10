@extends('layout.layoutgeneral')

@section('titulo', 'Orden para asignar')

@section('cuerpo')
    <div class="container pt-3">
        <a href="{{ route('order.asig') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i>
            Regresar</a>
    </div>
    <div class="container text-center py-4 col-7 pt-5">
        <div class="card pt-5">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Asignación de Técnico</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('order.asignado') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2 fw-bolder">No. Orden</span>
                        <input type="text" class="form-control" value="{{ $orden->norden }}" name="orden" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2 fw-bolder">Nombre</span>
                        <span class="input-group-text col-3 text-wrap">{{ $orden->nombre }}</span>
                        <span class="input-group-text col-2 fw-bolder">Apellido</span>
                        <span class="input-group-text col-3 text-wrap">{{ $orden->apellidos }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2 fw-bolder">Serial</span>
                        <span class="input-group-text col-8 text-wrap">{{ $orden->serial }}</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text col-2 fw-bolder">Marca</span>
                        <span class="input-group-text col-3 text-wrap">{{ $orden->marca }}</span>
                        <span class="input-group-text col-2 fw-bolder">Modelo</span>
                        <span class="input-group-text col-3 text-wrap">{{ $orden->modelo }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text col-2 fw-bolder">Tipo dispositivo</span>
                        <span class="input-group-text col-5 text-wrap">{{ $orden->tipo }}</span>
                    </div>
                    <div class="input-group mb-3 pt-3">
                        <span class="input-group-text col-3 fw-bolder">Técnico a asignar</span>
                        <select class="form-select" id="usertec" name="tecnico">
                            <option selected value="">Seleccionar...</option>
                            @foreach ($tecnico as $asignar)
                                <option value="{{ $asignar->id }}">{{ $asignar->unombre }} {{ $asignar->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('tecnico')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    @can('order.asignado')
                        <div class="container">
                            <button class="btn btn-outline-primary"><i class="bi bi-clipboard-check"></i> Asignar</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection
