@extends('layout.layoutgeneral')

@section('titulo', 'Orden')

@section('cuerpo')
    <div class="container pt-3">
        <a href="{{ route('order.show', $consulta->norden) }}" class="btn btn-outline-primary"><i
                class="bi bi-arrow-left-square"></i> Regresar</a>
    </div>
    <div class="container text-center py-4 col-9 pt-5">
        {{-- sección para clientes --}}
        @if (session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('info') }}.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <h5 class="card-header text-center bg-primary text-white">Cliente</h5>
            <div class="card-body">
                <form action="{{ route('cliente.updated') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <label class="input-group-text col-2 fw-bolder">Número de DPI</label>
                        <input type="text" class="form-control" name="cui" value="{{ $consulta->cui }}" readonly>
                        <label for="" class="input-group-text col-2 fw-bolder">NIT</label>
                        <input type="text" class="form-control" name="nit" value="{{ $consulta->nit}}">
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-2 fw-bolder">Nombres</label>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="nombre" value="{{ $consulta->nombre }}">

                        <label class="input-group-text col-2 fw-bolder">Apellidos</label>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="apellidos"
                            value="{{ $consulta->apellidos }}">
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-2 fw-bolder">Número de celular</label>
                        <input type="number" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="celular" value="{{ $consulta->ncelular }}">
                        <label for="" class="input-group-text col-2 fw-bolder">E-mail</label>
                        <input type="text" class="form-control" name="correo" value="{{ $consulta->correo}}">
                    </div>
                    @error('celular')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span for="">{{ $message }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <div class="container text-center">
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
        {{-- sección para hardware --}}
        <div class="card">
            <h5 class="card-header text-center bg-primary text-white">Hardware</h5>
            <div class="card-body">
                <form action="{{ route('hardware.updated') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <label class="input-group-text col-2 fw-bolder">Serial</label>
                        <input type="text" class="form-control" name="serial" value="{{ $consulta->serial }}" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-2 fw-bolder">Modelo</label>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="modelo" value="{{ $consulta->modelo }}">
                        <label class="input-group-text col-2 fw-bolder">Marca</label>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="marca" value="{{ $consulta->marca }}">
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="input-group-text col-2 fw-bolder">Tipo de dispositivo</label>
                        <input type="text" class="form-control" name="tipo" value="{{ $consulta->tipo}}" readonly>

                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-2 fw-bolder">Detalles</label>
                        <textarea class="form-control" aria-label="With textarea" name="detalles">{{ $consulta->h_detalles }}</textarea>
                    </div>
                    <div class="container text-center">
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- sección para la orden --}}
        <div class="card">
            <h5 class="card-header text-center bg-primary text-white">Orden de Trabajo</h5>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <form action="{{ route('order.updated', $consulta->norden) }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <p class="input-group-text col-2 fw-bolder">No Orden</p>
                            <p class="form-control d-flex">{{ $consulta->norden }}</p>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupSelect01">Técnico
                                Asignado</label>
                            <select class="form-select" id="usertec" name="tecnico">
                                @if ($asignado == null)
                                    <option selected value=""> Sin Asignar</option>
                                @else
                                    <option selected value="{{ $asignado->id_user }}">{{ $asignado->unombre }}
                                        {{ $asignado->apellido }}</option>
                                @endif
                                @foreach ($usuario as $user)
                                    <option value="{{ $user->id }}">{{ $user->unombre }} {{ $user->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label for="inputGroupSelect02" class="input-group-text col-2 fw-bolder">Estado de la
                                Orden</label>
                            <select name="estado" id="state" class="form-select">
                                <option selected value="{{ $consulta->estado }}">{{ $consulta->estado }} </option>
                                <option value="En Espera">En Espera</option>
                                <option value="Reparado">Reparado</option>
                                <option value="No Reparado">No Reparado</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text  fw-bolder col-2">Fecha Estimada</span>
                            <input type="date" name="fecha_estimada" id="fecha_salida"
                                value="{{ $consulta->fecha_estimada }}">
                            @error('fecha_estimada')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- orden --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text col-2 overflow-auto fw-bolder">Problema</span>
                            <textarea class="form-control" aria-label="With textarea" name="comentarios">{{ $consulta->comentarios }}</textarea>
                        </div>
                        <div class="container text-center">
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i>
                                Guardar</button>
                        </div>
                    </form>
                </blockquote>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection
