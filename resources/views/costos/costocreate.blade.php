@extends('layout.layoutgeneral')

@section('titulo', 'costos de reparacion')


@section('cuerpo')
    <div class="container col-4">
        <form action="">
            <div class="input-group">
                <div class="input-group mb-3">
                    <span class="input-group-text col-3">Descripción</span>
                    <input type="text" name="dpi" id="cui" class="form-control">
                </div>
            </div>
            <div class="input-group">
                <div class="input-group mb-3">
                    <span class="input-group-text col-3">Costo</span>
                    <input type="text" name="dpi" id="cui" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection
