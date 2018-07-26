@inject('objCongregacionController', 'App\Http\Controllers\CongregacionController')
@inject('objPermisos', 'App\Http\Controllers\Permisos_userController')
@extends('includes.template')
@section('content')
<!-- Inicio Modales -->
@php
  $acceso = $objPermisos->permisoParaSeguir("permisosCuentas", "controlTotal")
@endphp

@if($acceso)
  <div class="modal fade" id="AgregarRecibo" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Nuevo Recibo</h4>
                </div>
                <div class="modal-body">

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Información Recibo</h3>
                    </div>
                    <div class="panel-body">

                      <div class="form-group">
                        <label for="fechaRecibo">Fecha</label>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                          <input id="fechaRecibo" type="date" class="form-control">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Seleccione la fecha del recibo."><span class="fa fa-question-circle"></span></div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tipoRecibo">Tipo de Recibo</label>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="fa fa-bank"></span></div>
                          <select class="form-control" id="tipoRecibo">
                            @foreach($objCongregacionController->tiposRecibos as $key => $tipo)
                            <option value="{{ $key }}">{{ $tipo }}</option>
                            @endforeach
                          </select>
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Seleccione el tipo del recibo que va a adicionar."><span class="fa fa-question-circle"></span></div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="valorRecibo">Valor</label>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="fa fa-money"></span></div>
                          <input type="number" class="form-control" id="valorRecibo" placeholder="Digite aquí el valor">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Digite el valor."><span class="fa fa-question-circle"></span></div>
                        </div>
                      </div>

                      <div class="form-group" id="container_descripcionRecibo" style="display: none">
                        <label for="descripcionRecibo">Descripcion</label>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="fa fa-file-text-o"></span></div>
                          <input type="text" class="form-control" id="descripcionRecibo" placeholder="Digite la descripcion detallada">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Digite la descripcion detallada del movimiento. Si se trata de un gasto, defina sobre que fue ese gasto. En caso de que sea una consignacion bancaria, esbriba el nombre del banco donde se realizo la consignaci&oacute;n"><span class="fa fa-question-circle"></span></div>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btGuardarRecibo" name="btGuardarRecibo" class="btn btn-guardar">Guardar</button>
                    <button type="button" class="btn btn-cerrar" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Fin Modales -->


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ $infoCarpeta->annio."/".$objCongregacionController->nombreMeses[$infoCarpeta->mes] }}
          @if($acceso)
            <a data-id="{{ $infoCarpeta->id }}" class="btnEliminarCarpeta pointer">
              <span class="fa fa-trash fa-1x pointer pull-right"></span>
            </a>
          @endif
        </h1>
    </div>
    <div class="col-md-12">

      <div class="col-md-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <i class="fa fa-dollar fa-2x"></i>
                        <strong>{{ number_format($inicioMes, 0, ",", ".") }}</strong>
                    </div>
                </div>
            </div>
            <a>
                <div class="panel-footer">
                    <span class="pull-left">  Inicio Mes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
      </div>

      <div class="col-md-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <i class="fa fa-dollar fa-2x"></i>
                        <strong id="value_totalEntradaCongregacion">{{ $totalEntradaCongregacion }}</strong>
                    </div>
                </div>
            </div>
            <a class="pointer colorTable" data-option="EC">
                <div class="panel-footer">
                    <span class="pull-left">Entrada Congre</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
      </div>

      <div class="col-md-2">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <i class="fa fa-dollar fa-2x"></i>
                        <strong id="value_totalGastos">{{ $totalGastos }}</strong>
                    </div>
                </div>
            </div>
            <a class="pointer colorTable" data-option="TG">
                <div class="panel-footer">
                    <span class="pull-left">Total Gastos</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
      </div>

      <div class="col-md-2">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <i class="fa fa-dollar fa-2x"></i>
                        <strong id="value_balance">{{ $balance }}</strong>
                    </div>
                </div>
            </div>
            <a>
                <div class="panel-footer">
                    <span class="pull-left">Balance</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
      </div>

      <div class="col-md-2">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <i class="fa fa-dollar fa-2x"></i>
                        <strong id="value_totalObraMundial">{{ $totalObraMundial }}</strong>
                    </div>
                </div>
            </div>
            <a class="pointer colorTable" data-option="OM">
                <div class="panel-footer">
                    <span class="pull-left">Obra Mundial</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
      </div>

      <div class="col-md-2">
        <div class="panel panel-purple">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <i class="fa fa-dollar fa-2x"></i>
                        <strong id="value_totalConsignacion">{{ $totalConsignacion }}</strong>
                    </div>
                </div>
            </div>
            <a class="pointer colorTable" data-option="CO">
                <div class="panel-footer">
                    <span class="pull-left">Consignado</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
      </div>

    </div><!-- Fin resumen mes -->

    <div class="col-md-12">

      <div class="panel panel-default">
          <div class="panel-heading">
              Listado de Recibos del Mes
              @if($acceso)
                <span class="pointer fa fa-plus pull-right" data-toggle="modal" data-target="#AgregarRecibo"></span>
              @endif
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">

                <table class="table table-striped table-bordered table-hover">
                  <thead>
                      <tr>
                        <th>Mes/Dia</th>
                        <th class="hidden-xs">Movimiento</th>
                        <th>Valor</th>
                        <th>Descripcion</th>
                        @if($acceso)
                          <th></th>
                        @endif
                      </tr>
                  </thead>
                  <tbody id="tblRecibosBody">
                    @foreach($lstRecibos as $recibo)
                    <tr class="tipoRecibo{{ $recibo->tipo }}">
                      <td>{{ date("m/j",$recibo->fecha) }}</td>
                      <td class="hidden-xs">{{ $objCongregacionController->tiposRecibos[$recibo->tipo] }}</td>
                      <td>{{ number_format($recibo->valor, 0, ",", ".") }}</td>
                      <td>{{ $recibo->descripcion }}</td>
                      @if($acceso)
                        <td class="text-center"><span class="fa fa-trash pointer deleteRecibo" data-identificacion="{{ $recibo->id }}"></span></td>
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
              </table>

          </div>
          <!-- /.panel-body -->
      </div>

    </div>
    <div class="col-md-12">
      <div class="col-xs-6 col-md-4 text-center">
        <a class="pointer color-black" href="{{ config("constantes.URL_BASE") }}Remesa/{{ $infoCarpeta->id }}" target="_blank">
          <span class="fa fa-file-pdf-o fa-5x pointer"></span><br>
          Remesa
        </a>
      </div>
      <div class="col-xs-6 col-md-4 text-center">
        <a class="pointer color-black" href="{{ config("constantes.URL_BASE") }}hojaCuentas/{{ $infoCarpeta->id }}" target="_blank">
          <span class="fa fa-file-pdf-o fa-5x pointer"></span><br>
          Hoja de Cuentas
        </a>
      </div>
      <div class="col-xs-12 col-md-4 text-center">
        <a class="pointer color-black" href="{{ config("constantes.URL_BASE") }}informeMensual/{{ $infoCarpeta->id }}" target="_blank">
          <span class="fa fa-file-pdf-o fa-5x pointer"></span><br>
          Informe Mensual
        </a>
      </div>
    </div>
<input type="hidden" id="idCarpeta" value="{{ $infoCarpeta->id }}">
    <!-- /.col-lg-12 -->
</div>
@endsection
