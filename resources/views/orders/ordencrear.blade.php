@extends('layout.layoutgeneral')

@section('titulo', 'OT (Orden de Trabajo)')

@section('cuerpo')
    <div class="container text-center py-4 col-8 pt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center"> Orden de Trabajo (OT)</h4>
            </div>
        </div>
        <div class="card-body">
            <form name="" action="{{ route('order.store') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <label class="input-group-text col-2 fw-bolder">Fecha</label>
                    <input type="text" placeholder="" value="{{ date('Y-m-d') }}" readonly>
                    <input type="text" name="num" id="num" class="visually-hidden" value="{{ $customid }}" readonly>
                </div>
                {{-- apartado de cliente --}}
                <div class="input-group mb-3">
                    <label class="input-group-text col-2 fw-bolder">DPI</label>
                    <input type="text" name="dpi" id="cui" class="form-control" value="{{ $cui }}" readonly>
                    <label class="input-group-text col-2 fw-bolder">NIT</label>
                    <input type="text" name="nit" id="nit" class="form-control" value="{{ $nitval }}" readonly>
                    @error('dpi')
                        <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text col-2 fw-bolder">Nombres</label>
                    <input type="text" name="nombre" id="firstname" class="form-control" value="{{ $nombre }}" disabled>
                    <label class="input-group-text col-2 fw-bolder">Apellidos</label>
                    <input type="text" name="apellido" id="secondename" class="form-control" value="{{ $apellido }}" disabled>
                </div>
                <div class="input-group mb-3">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text col-2 fw-bolder">Serial</label>
                    <input type="text" name="serial" id="serie" class="form-control" value="{{ $serial }}" readonly>
                    @error('serial')
                        <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text col-2 fw-bolder">Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control" value="{{ $marca }}" disabled>
                    <label class="input-group-text col-2 fw-bolder">Modelo</label>
                    <input type="text" name="modelo" id="modelo" class="form-control" value="{{ $modelo }}" disabled>
                </div>
                <div class="input-group mb-3">
                    <label for="" class="input-group-text col-2 fw-bolder">Tipo Dispositivo</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" value="{{ $tipo }}" readonly>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text col-2 fw-bolder">Observaciones</label>
                    <textarea class="form-control" aria-label="With textarea" name="D. Hardware" readonly id="hardware">{{ $comentarios }}</textarea>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text col-2 fw-bolder">Problema</label>
                    <textarea class="form-control" aria-label="With textarea" name="problema">{{ old('problema') }}</textarea>
                </div>
                @error('problema')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <div class="input-group mb-3">
                    <strong class="input-group-text  fw-bolder col-2">Fecha Estimada</strong>
                    <input type="date" name="fecha_estimada" id="fecha_salida">
                </div>
                @error('fecha_estimada')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <div class="container text-center pt-3">
                    @can('order.create')
                        <button type="submit" class="btn btn-outline-primary fw-bolder"><i class="bi bi-save"></i> Registrar</button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
@endsection
