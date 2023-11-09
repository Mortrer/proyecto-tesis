@extends('layout.layoutgeneral')

@section('titulo', 'Presupuesto')

@section('cuerpo')
    <div class="container pt-3">
        <a href="{{ route('order.repord', $id) }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i>
            Regresar</a>
    </div>
    <div class="container col-8 pb-5 pt-5">
        <form action="{{ route('budget.guardar') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <label for="" class="input-group-text col-2 fw-bolder">No. Orden</label>
                <input type="text" class="form-control" name="id_norden" id="orden" value="{{ $id }}"
                    readonly>
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
    <div class="container">
        <a href="{{ route('cost.store', $id) }}" class="btn btn-outline-primary"><i class="bi bi-file-arrow-down"></i> Generar
            Presupuesto</a>
    </div>
    <div class="container pt-3">
        @if (session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('info') }}.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('info2'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('info2') }}.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="container">
        <div id="rel">
            <table class="table" id="budgets">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budg as $key => $presu)
                        <tr>
                            {{-- <td scope="row">{{ $presu->id }}</td> --}}
                            <td scope="row" class="col-1">{{ $key + 1 }}</td>
                            <td scope="row">{{ $presu->nombre }}</td>
                            <td scope="row">{{ $presu->detalle }}</td>
                            <td scope="row">{{ $presu->costo }}</td>
                            <td scope="row" class="col-2"><a href=" {{ route('budget.destro', $presu->id) }}"
                                    class="btn btn-outline-primary">Eliminar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endsection

@section('script')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />

    <script type="text/javascript" src="/DataTables/datatables.min.js"></script>

    <script>
        window.addEventListener('load', function() {
            var guardar = document.getElementById('boton');
            var consulta = document.getElementById('consultar');
            var clear = document.getElementById('delete');

            var orden = document.getElementById('orden');
            var nombre = document.getElementById('name');
            var costo = document.getElementById('costo');
            var detalle = document.getElementById('detalle');

        })
    </script>


@endsection
