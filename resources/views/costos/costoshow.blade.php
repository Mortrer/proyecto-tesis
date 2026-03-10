@extends('layout.layoutgeneral')

@section('titulo', 'Presupuesto')


@section('cuerpo')
    <div class="container py-4 col-13 pt-5">
        <div class="container pt-2">
            <a href="{{ route('costo.index') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i>
                Regresar</a>
        </div>
        <div class="card pt-3">
            <div class="card-header">
                <div class="container text-center pb-3">
                    @if ($costoVerificar->estado == 'En espera de confirmación')
                    <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#miModal"><i
                            class="bi bi-card-checklist"></i> Aceptar Presupuesto</a>
                    @else
                        
                    @endif
                </div>
                <div class="container col-9">
                    <form action="{{ route('budget.guardar') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <label for="" class="input-group-text col-2 fw-bolder">No. Orden</label>
                            <input type="text" class="form-control" name="id_norden" id="orden"
                                value="{{ $id }}" readonly>
                            <label for="categoria" class="input-group-text col-2 fw-bolder">Categoría</label>
                            <select name="categoria" id="name" class="form-select">
                                <option selected value="">Selección </option>
                                <option value="Video">Video</option>
                                <option value="Audio">Audio</option>
                                <option value="Encendido">Encendido</option>
                                <option value="Sistema Operativo">Sistema Operativo</option>
                                <option value="Otros">Otros</option>
                            </select>
                            <label for="categoria" class="input-group-text col-1 fw-bolder">Tipo</label>
                            <select name="tipo" id="name" class="form-select">
                                <option selected value="">Selección </option>
                                <option value="Costo">Costo</option>
                                <option value="Garantia">Garantia</option>
                            </select>
                        </div>
                        @error('categoria')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span for="">{{ $message }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        @error('tipo')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span for="">{{ $message }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <label for="detalle" class="input-group-text col-2 fw-bolder">Detalle</label>
                            <textarea class="form-control" aria-label="With textarea" name="detalle" id="detalle"></textarea>
                        </div>
                        @error('detalle')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span for="">{{ $message }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <label for="costo" class="input-group-text col-2 fw-bolder">Costo Q.</label>
                            <input type="number" class="form-control" name="costo" step=".01" id="costo">
                            <button class="btn btn-outline-primary" id="boton"><i class="bi bi-plus-circle"></i>
                                Crear</button>
                        </div>
                        @error('costo')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span for="">{{ $message }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </form>
                </div>
                <div class="container pt-3">
                    <a href="{{ route('cost.store', $id) }}" class="btn btn-outline-primary"><i
                            class="bi bi-file-arrow-down"></i> Generar Presupuesto</a>
                </div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table table-light table-striped" id="costos" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($budgets as $key => $budget)
                            <tr>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td scope="row">{{ $budget->nombre }}</td>
                                <td scope="row">Q. {{ $budget->costo }}</td>
                                <td scope="row">{{ $budget->detalle }}</td>
                                <td scope="row"><a class="btn btn-outline-primary"
                                        href="{{ route('budget.destro', $budget->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i> Eliminar</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-scrollable">
                    <form action="{{ route('costo.aceptar') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="container text-center">
                                    <h5 class="modal-title fw-bolder" id="miModalLabel">Aceptar Presupuesto</h5>
                                </div>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <label for="" class="fw-bolder col-4 input-group-text">No.Orden</label>
                                        <input type="text" class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" name="orden"
                                            value="{{ $id }}" readonly>
                                    </div>

                                    <div class="input-group mb-3">
                                        <label class="input-group-text col-4 fw-bolder"
                                            for="inputGroupSelect01">Estado</label>
                                        <select class="form-select" id="usertec" name="estado">
                                            <option selected value="">Seleccionar...</option>
                                            <option value="Aceptado">Aceptar</option>
                                            <option value="Rechazado">Rechazar</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="fw-bolder col-4 input-group-text">Comentario</label>
                                        <textarea class="form-control" aria-label="With textarea" name="comentario" id="comentario"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="if (!confirm('¡Recuerda proceder únicamente si se comunico anteriormente con el cliente')) { return false; }">Entregar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('script')

@endsection
