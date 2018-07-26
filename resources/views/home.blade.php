@inject('objPermisos', 'App\Http\Controllers\Permisos_userController')

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      @if($objPermisos->permisoParaSeguir("permisosCuentas", "controlTotal") || $objPermisos->permisoParaSeguir("permisosCuentas", "soloLectura"))
          <div class="col-md-4">
              <a href="{{ config('constantes.URL_BASE') }}congregacion/1">
                <div class="panel panel-default">
                    <div class="panel-heading">Congregación Cordoba</div>

                    <div class="panel-body">
                        Entrar a cuentas
                    </div>
                </div>
              </a>
          </div>
        @endif
        @if(Auth::user()->id == 1)
        <div class="col-md-4">
            <a href="{{ config("constantes.URL_BASE") }}usuarios">
              <div class="panel panel-success">
                  <div class="panel-heading">Gestión de Usuarios</div>
                  <div class="panel-body">
                      Cree, elimine , modifique y gestione los permisos de los Usuarios.
                  </div>
              </div>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
