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
        @include('nav.headernav');
    </div>

    <main class="container">
        <div class="container text-center">
            <h1 class="py-5 text-center">Bienvenido al Sistema</h1>
            <h2 class="py-3 text-center">Iniciar Sesion</h2>
        </div>
        <div class="container col-4">
            <form action="" name="formulario" method="POST">
                @csrf
                <div class="form-group" id="enviar">
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-3" id="name">Usuario</span>
                            <!--maxlength="5"-->
                            <input type="text" name="user" id="usuario" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text col-3" id="name">Contraseña</span>
                            <!--maxlength="5"-->
                            <input type="password" name="user" id="usuario" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="container text-center">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
