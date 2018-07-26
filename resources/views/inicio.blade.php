@inject('objCongregacionController', 'App\Http\Controllers\CongregacionController')
@extends('includes.template')
@section('content')
<div class="row">
  <div class="col-md-12">
    <h3 class="descripcionHora">Ultima Actualización: {{ ($lastRecibo != false)? $lastRecibo->updated_at : "Sin información" }}</h3>
  </div>
  <div class="col-md-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-12">
                    <i class="fa fa-dollar fa-2x"></i>
                    <strong>{{ $objCongregacionController->set_miles($disponible) }}</strong>
                </div>
            </div>
        </div>
        <a>
            <div class="panel-footer">
                <span class="pull-left"> DISPONIBLE EN CAJA</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
  </div>
</div>

@endsection
