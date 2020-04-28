@extends('layouts.app')

@section('title', 'Inicio | Eldir: Registro de Actividad')

@section('content')

<div class="container size-letra">
    <div class="row text-center">
        <div class="col-md-12 d-none d-sm-block">
            <a class="btn btn-primary btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#revisitas">Revisitas Urgentes</a>
            <a class="btn btn-primary btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#comoVoy">Voy Bien!</a>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-12">
            <div class="d-md-none d-lg-none d-xl-none d-sm-none">
                <a class="btn btn-primary btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#revisitas">Revisitas</a>
                <a class="btn btn-primary btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#comoVoy">Voy Bien!</a>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div id="revisitas" class="col-sm-12 panel-collapse collapse">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Últ. Visita</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row text-center">
        
    </div>
    <div class="row bloque-acceso-rapido" id="row-home">
        <div class="col-md-12">
            <p class="text-home">
                <span id="texto-actividad"></span> <span id="estado-meta"></span>
                <a class="btn btn-primary float-right" href="{!! route('actividad.create') !!}"><strong>+</strong> Actividad</a>
            </p>
        </div>
        <br><br>
        <div class="col-md-12">
            <p class="text-home">
                <span id="texto-revisitas"></span>
                <a class="btn btn-primary float-right" href="{!! route('persona.index') !!}"><strong>+</strong> Revisita</a>
            </p>
        </div>
        <br><br>
        <div class="col-md-12">
            <p class="text-home">
                <span id="texto-personas"></span>
                <a class="btn btn-primary float-right" href="{!! route('visita.create') !!}"><strong>+</strong> Interesad@</a>
            </p>
        </div>
        <br><br>
        <div class="col-md-12 text-center">
            <a class="btn btn-primary" href="{!! route('informe') !!}">Informe</a> <a class="btn btn-primary" href="#">Notas</a>
        </div>
    </div>
</div>

@endsection