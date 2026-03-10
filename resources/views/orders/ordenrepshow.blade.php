@extends('layout.layoutgeneral')

@section('titulo', 'Ordenes')

@section('cuerpo')
    <div class="container pt-3">
        <a href="{{ route('order.rep') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i> Regresar</a>
    </div>
    <div class="container py-4 col-10 pt-5">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('budget.create', $order->norden) }}" class="btn btn-outline-primary"><i
                        class="bi bi-cash-stack"></i> Crear Presupuesto</a>

                <div class="container pt-3">
                    @if (session('info'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('info') }}.</strong>
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
            </div>
            <div class="card-body">
                <form action="{{ route('order.repf') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-2 fw-bolder">No. Orden</span>
                            <input type="text" class="form-control" value="{{ $order->norden }}" name="orden" readonly>
                            <span class="input-group-text col-2 fw-bolder" for="inputGroupFile01">No. Celular</span>
                            <span for="" class="input-group-text col-3">{{ $order->ncelular }}</span>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Nombre</label>
                            <label for="" class="input-group-text col-3">{{ $order->nombre }}</label>
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Apellido</label>
                            <label for="" class="input-group-text col-3">{{ $order->apellidos }}</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Marca</label>
                            <label for="" class="input-group-text col-3">{{ $order->marca }}</label>
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Modelo</label>
                            <label for="" class="input-group-text col-3">{{ $order->modelo }}</label>
                        </div>
                        <div class="input-group mb-3">
                            <label for="" class="input-group-text col-2 fw-bolder">Tipo de dispositivo</label>
                            <label for="" class="input-group-text col-3">{{ $order->tipo }}</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Serial</label>
                            <label for="" class="input-group-text col-6">{{ $order->id_equipo }}</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Fecha Estimada</label>
                            <label for="" class="input-group-text col-6">{{ $order->fecha_estimada }}</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Observaciones</label>
                            <label for="" class="input-group-text col-6">{{ $order->h_detalles }}</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupFile01">Problema</label>
                            <label for="" class="input-group-text col-6">{{ $order->comentarios }}</label>
                        </div>
                    </div>
                    @switch($order->estado)
                        @case('Reparado')
                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bolder col-2">Reparación</span>
                                <textarea class="form-control" aria-label="With textarea" name="reparacion" readonly>{{ $costo->descripcion }}</textarea>
                            </div>
                        @break

                        @case('No Reparado')
                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bolder col-2">Reparación</span>
                                <textarea class="form-control" aria-label="With textarea" name="reparacion" readonly>{{ $costo->descripcion }}</textarea>
                            </div>
                        @break

                        @case('En Espera')
                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bolder col-2">Reparación</span>
                                <textarea class="form-control" aria-label="With textarea" name="reparacion">{{ $costo->descripcion }}</textarea>
                            </div>
                        @break

                        @default
                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bolder col-2">Reparación</span>
                                <textarea class="form-control" aria-label="With textarea" name="reparacion"></textarea>
                            </div>
                    @endswitch
                    @error('reparacion')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bolder col-2">Comentario del Cliente</span>
                            <textarea class="form-control" aria-label="With textarea" name="clientecomentario" readonly>{{ $order->comentario }}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="inputGroupSelect01">Estado</label>
                            <select class="form-select" id="usertec" name="estado">
                                @if ($order->estado)
                                    <option selected value="{{ $order->estado }}">{{ $order->estado }}</option>
                                @else
                                    <option selected value="">Seleccionar...</option>
                                @endif
                                <option value="En Espera">En Espera</option>
                                <option value="Reparado">Reparado</option>
                                <option value="No Reparado">No Reparado</option>
                            </select>
                            <label for="" class="input-group-text col-2 fw-bolder">Estado del Presupuesto</label>
                            <span class="input-group-text col-3">{{ $order->costEstado }}</span>
                            <label for="" class="input-group-text col-2 fw-bolder">Costo Total</label>
                            <span class="input-group-text">Q {{ $order->precio }}</span>
                        </div>
                        @if (session('info3'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('info3') }}.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @error('estado')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        @if ($costo)
                            <div class="container text-center">
                                <button type="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i>
                                    Enviar</button>
                            </div>
                        @else
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('script')


    @endsection
