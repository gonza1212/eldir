<?php
$ruta_servidor = realpath(__DIR__."/..");
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/cuaderno.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Estamos en mantenimiento</title>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/fa-svg-with-js.css" rel="stylesheet">
    <link href="/css/estilos.css" rel="stylesheet">
</head>
<body style="background-image: url('/images/mantenimiento.jpg');
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: #464646;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="letra-mantenimiento">Estamos en mantenimiento...</h1>
                <h3 style="color: white;">Trabajamos para brindarle una experiencia más agradable.<br>Lamentamos los inconvenientes. ¡Volveremos a estar en línea en breves momentos!</h3>
            </div>
        </div>
    </div>
</body>