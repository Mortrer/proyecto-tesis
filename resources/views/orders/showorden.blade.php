@extends('layout.layoutgeneral')

@section('titulo', 'Ordenes')

@section('cuerpo')
    <div class="container pt-3">
        <a href="{{ route('order.index') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i>
            Regresar</a>
    </div>
    <div class="container text-center py-4 col-10 pt-2">
        <div class="container text-center pb-3">
            @can('order.update')
                <a href="{{ route('order.update', $ordenv->norden) }}" class="btn btn-outline-primary"><i
                        class="bi bi-pencil-square"></i> Editar | Actualizar</a>
            @endcan

            @can('order.imprimir')
                <a href="{{ route('order.imprimir', $ordenv->norden) }}" class="btn btn-outline-primary"><i
                        class="bi bi-printer-fill"></i> Imprimir</a>
            @endcan

            @can('order.entrega')
                @if ($ordenv->estado == 'Entregado')
                @else
                    <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#miModal"><i
                            class="bi bi-truck"></i> Entrega</a>
                @endif
            @endcan

        </div>
        <div class="container col-8">
            <div class="card">
                <div class="container">
                    @if (session('info'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('info2') }}.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('info2'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('info2') }}.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="card-header bg-primary text-white">
                    <div class="container text-center">
                        <h3>Detalles de la Orden de Trabajo</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <label for="fecha-de-creacion" class="fw-bold col-3 input-group-text">Fecha de Creación</label>
                        <span class="d-flex input-group-text col-3"> {{ $ordenv->created_at }}</span>
                        <label for="fecha-estimada" class="fw-bold col-2.5 input-group-text">Fecha estimada</label>
                        <span class="d-flex input-group-text col-3">{{ $ordenv->fecha_estimada }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <label for="Fecha-de-creacion" class="fw-bold col-3 input-group-text">No. Orden</label>
                        <span class="d-flex input-group-text col-5">{{ $ordenv->norden }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <label for="Cliente" class="fw-bold col-2 input-group-text">DPI</label>
                        @if ($ordenv->cui == null)
                            <span class="d-flex col-4 input-group-text"> Sin especificar</span>
                        @else
                            <span class="d-flex col-4 input-group-text">{{ $ordenv->cui }}</span>
                        @endif
                        <label for="" class="fw-bolder col-2 input-group-text">NIT</label>
                        @if ($ordenv->nit == null)
                            <span class="form-control"> Sin especificar</span>
                        @else
                            <span class="form-control"> {{ $ordenv->nit }}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-2 input-group-text">Nombre</label>
                        <span class="d-flex col-4 input-group-text">{{ $ordenv->nombre }}</span>
                        <label for="" class="fw-bolder col-2 input-group-text">Apellido</label>
                        <span class="d-flex col-4 input-group-text"> {{ $ordenv->apellidos }}</span>
                    </div>

                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-3 input-group-text">Número de celular</label>
                        <span class="d-flex col-3 input-group-text">{{ $ordenv->ncelular }}</span>
                        <label for="" class="fw-bolder col-2 input-group-text">E-mail</label>
                        <span class="d-felx col-4 input-group-text"> {{ $ordenv->correo }}</span>
                    </div>

                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-2 input-group-text">Serial</label>
                        <span class="d-flex col-10 input-group-text">{{ $ordenv->id_equipo }}</span>
                    </div>

                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-2 input-group-text">Marca</label>
                        <span class="d-flex col-4 input-group-text">{{ $ordenv->marca }}</span>
                        <label for="" class="fw-bolder col-2 input-group-text">Modelo</label>
                        <span class="d-flex col-4 input-group-text">{{ $ordenv->modelo }}</span>
                    </div>
                    <div class="class input-group mb-3">
                        <label for="" class="fw-bolder col-3 input-group-text">Tipo de Dispositivo</label>
                        <span class="d-flex col-4 input-group-text">{{ $ordenv->tipo }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder input-group-text">Observaciones</label>
                        <textarea class="form-control" aria-label="With textarea" readonly>{{ $ordenv->h_detalles }}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder input-group-text">Comentario cliente</label>
                        <textarea class="form-control" aria-label="With textarea" readonly>{{ $ordenv->comentario }}</textarea>

                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-3 input-group-text">Técnico Asignado</label>
                        @if ($ordenv->id_user == null)
                            <span class="d-flex col-9 input-group-text">Equipo no asignado</span>
                        @else
                            <span class="d-flex col-9 input-group-text">{{ $ordenv->unombre }}
                                {{ $ordenv->apellido }}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-3 input-group-text">Estado Orden</label>
                        <span class="d-flex col-3 input-group-text">{{ $ordenv->estado }}</span>
                        <label for="" class="fw-bolder col-3 input-group-text">Estado Presupuesto</label>
                        <span class="d-flex col-3 input-group-text">{{ $ordenv->costoEstado }}</span>
                    </div>

                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-3 input-group-text">Problema</label>
                        <textarea class="form-control" aria-label="With textarea" readonly>{{ $ordenv->comentarios }}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-3 input-group-text">Reparación</label>
                        <textarea class="form-control" aria-label="With textarea" readonly>{{ $ordenv->descripcion }}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="fw-bolder col-3 input-group-text">Costo Total</label>
                        <span class="d-flex col-4 input-group-text">Q.{{ $ordenv->precio }}</span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <form action="{{ route('orden.entrega') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="container text-center">
                                        <h5 class="modal-title fw-bolder" id="miModalLabel">Orden a Entregar</h5>
                                    </div>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group">
                                        <div class="input-group mb-2">
                                            <label for="" class="fw-bolder input-group-text col-2">Orden</label>
                                            <input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default" name="orden"
                                                value="{{ $ordenv->norden }}" readonly>
                                            <label for="" class="fw-bolder input-group-text">Fecha Entrega</label>
                                            <span class="form-control">{{ $ordenv->fecha_estimada }}</span>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="" class="fw-bolder input-group-text col-2">Nombre</label>
                                            <span class="form-control">{{ $ordenv->nombre }}</span>
                                            <label for=""
                                                class="fw-bolder input-group-text col-2">Apellido</label>
                                            <span class="form-control">{{ $ordenv->apellidos }}</span>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="" class="fw-bolder input-group-text col-2">E-mail</label>
                                            <span class="form-control col-6"> {{ $ordenv->correo }}</span>
                                            <label for="" class="fw-bolder input-group-text col-1">NIT</label>
                                            @if ($ordenv->nit == null)
                                                <span class="form-control"> Sin especificar</span>
                                            @else
                                                <span class="form-control"> {{ $ordenv->nit }}</span>
                                            @endif
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="" class="fw-bolder input-group-text col-1">Serial</label>
                                            <span class="form-control">{{ $ordenv->id_equipo }}</span>
                                            <label for="" class="fw-bolder input-group-text">Tipo de
                                                Dispositivo</label>
                                            <span class="form-control">{{ $ordenv->tipo }}</span>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="" class="fw-bolder input-group-text col-2">Marca</label>
                                            <span class="form-control">{{ $ordenv->marca }}</span>
                                            <label for="" class="fw-bolder input-group-text col-2">Modelo</label>
                                            <span class="form-control">{{ $ordenv->modelo }}</span>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label for="" class="fw-bolder input-group-text col-5">Comentario del
                                                Cliente</label>
                                            <textarea class="form-control" aria-label="With textarea" name="detalles" readonly>{{ $ordenv->comentario }}</textarea>
                                        </div>

                                        <div class="input-group mb-2">
                                            <label for=""
                                                class="fw-bolder input-group-text col-3">Reparación</label>
                                            <textarea class="form-control" aria-label="With textarea" name="detalles" readonly>{{ $ordenv->descripcion }}</textarea>
                                        </div>

                                        <div class="input-group mb-2">
                                            <label for="" class="fw-bolder input-group-text col-2">Estado</label>
                                            <span class="form-control">{{ $ordenv->estado }}</span>
                                            <label for="" class="fw-bolder input-group-text col-3">Costo
                                                Total</label>
                                            <span class="form-control"> Q.{{ $ordenv->precio }}</span>
                                        </div>
                                        <div class="input-group mb-2">

                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="if (!confirm('¿Está seguro de enviar el formulario?')) { return false; }">Entregar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endsection
