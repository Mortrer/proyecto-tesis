<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('contenedores.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="container">
        @include('nav.headernav')
    </div>
    <main class="container">
        <div class="text-center">
            <div class="card" style="width: 7rem;">
                <a href="" class="btn btn-dark"><img src="Images/img-users.png" alt="" width="85px" height="100px"></a>
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                  <h5 class="card-title fw-bold" >Users</h5>
                </div>
              </div>
            <a href="{{ route('user.show') }}" class="btn btn-primary">Usuarios</a><!--Usuarios: contiene el listado de usuarios que se han creado, se pueden editar o crear usaurios -->
            <a href="{{ route('order.index') }}" class="btn btn-primary">Orden de Trabajo</a> <!--ordenes de trabajo, modificar, crear, asignar o finalizar las ordenes -->
            <a href="" class="btn btn-primary">Costos y Presupuestos</a> <!--los costos totales y presupuesto detallado de cada orden de trabajo-->
        </div>
    </main>
</body>
</html>
