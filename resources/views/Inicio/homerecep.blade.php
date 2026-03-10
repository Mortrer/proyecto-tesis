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
        @include('nav.headerecep');
    </div>

    <main class="container">
        <div class="container text-center">
            <h1 class="py-5 text-center">Bienvenido al Sistema</h1>
            <h2 class="py-3 text-center">Usuario</h2>
            <h2 class="py-3 text-center">{{$rol}}</h2>
        </div>
</body>

</html>
