@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </div>
                <div class="panel-body text-center">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                                <div class="d-none d-sm-block col-md-4 text-right">
                                    <label for="email" class="control-label font-weight-bold" style="padding-top: 6px; color: gray;">Correo Electrónico</label>
                                </div>
                                <div class="d-md-none d-lg-none d-xl-none d-sm-none col-md-4 text-left">
                                    <label for="email" class="control-label font-weight-bold" style="padding-top: 6px; color: gray;">Correo Electrónico</label>
                                </div>
                                <input id="email" type="email" class="form-control col-md-6" name="email" value="{{ old('email') }}" required autofocus style="background-color: #F6FFC0 !important; margin: 0px 8px 0px 8px;">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                                <div class="d-none d-sm-block col-md-4 text-right ">
                                <label for="password" class="control-label font-weight-bold" style="padding-top: 6px; color: gray;">Contraseña</label>
                            </div>
                            <div class="d-md-none d-lg-none d-xl-none d-sm-none col-md-4 text-left">
                                <label for="password" class="control-label text-right font-weight-bold" style="padding-top: 6px; color: gray;">Contraseña</label>
                            </div>
                                <input id="password" type="password" class="form-control col-md-6" name="password" required style="background-color: #F6FFC0 !important; margin: 0px 8px 0px 8px;">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Ingresar
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
