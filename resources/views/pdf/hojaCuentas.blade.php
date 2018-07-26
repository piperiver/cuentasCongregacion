@inject('CongregacionController', 'App\Http\Controllers\CongregacionController')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hoja de Cuentas</title>
  </head>
  <body>

    <div>
    <style>
      *{
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        font-size: 12px;
        text-transform: uppercase;
      }
      td{
        text-align: center;
        border: 1px solid #000;
        padding: 1px;
        font-size: 10px;
        height: 12px;
      }
      tr{
        height: 12px;
      }
      table{
        border-collapse: collapse;
      }
      .negro{
        background: #000;
      }
      .letraFinal{
        border: none;
        padding: 0;
        font-size: 8;
      }
    </style>
    <h1 style="text-align: center; font-size: 20px">HOJA DE CUENTAS</h1><br>
    <div style="width: 100%">
      <div style="width: 20%; display: inline-block; border-bottom: 1px solid #000; height: 13px; text-align: center">{{ $infoCongregacion->codigo }}</div>
      <div style="width: 20%; display: inline-block; border-bottom: 1px solid #000; height: 13px; text-align: center;margin-left: 7%">{{ $infoCongregacion->nombre }}</div>
      <div style="width: 20%; display: inline-block; border-bottom: 1px solid #000; height: 13px; text-align: center;margin-left: 4%">Cali - Valle</div>
      <div style="width: 20%; display: inline-block; border-bottom: 1px solid #000; height: 13px; text-align: center;margin-left: 7%">{{ $mes." / ".$infoCarpeta->annio }}</div>
    </div>
    <div style="width: 100%">
      <div style="width: 20%; display: inline-block;text-align: center; font-size: 10px">Núm. Cong.</div>
      <div style="width: 20%; display: inline-block;text-align: center; font-size: 10px;margin-left: 7%">Congregación</div>
      <div style="width: 20%; display: inline-block;text-align: center; font-size: 10px;margin-left: 4%">Ciudad y Departamento</div>
      <div style="width: 20%; display: inline-block;text-align: center; font-size: 10px;margin-left: 7%">Mes   /    Año</div>
    </div>

    <table>
      <tr>
        <td rowspan="2" style="text-align: center">Día Del Mes<br></td>
        <td>DEPÓSITOS A LA SUCURSAL</td>
        <td colspan="2">INGRESOS Y GASTOS</td>
        <td rowspan="2">DESCRIPCIÓN</td>
        <td colspan="2">EFECTIVO EN CAJA Y BANCO</td>
        <td rowspan="2">CONSTRUCCIÓN MUNDIAL DE SALONES DEL REINO</td>
        <td rowspan="2">DONACIONES PARA LA OBRA MUNDIAL</td>
        <td rowspan="2">OTRAS DONACIONES</td>
      </tr>
      <tr>
        <td>CANTIDAD</td>
        <td>ENTRADA</td>
        <td>SALIDA</td>
        <td>ENTRADA</td>
        <td>SALIDA</td>
      </tr>
      <tr>
        <td></td>
        <td class="negro"></td>
        <td>{{ $CongregacionController->set_miles($inicioMes) }}</td>
        <td class="negro"></td>
        <td style="white-space: nowrap">SALDO DEL MES ANTERIOR</td>
        <td>{{ $CongregacionController->set_miles($inicioMes) }}</td>
        <td class="negro"></td>
        <td class="negro"></td>
        <td class="negro"></td>
        <td class="negro"></td>
      </tr>
      @foreach($recibo as $rec)
        <tr>
          <td>{{ date("d", $rec->fecha) }}</td>
          <td>{{ ($rec->tipo == 5)? $CongregacionController->set_miles($rec->valor) : "" }}</td>
          <td>{{ ($rec->tipo == 1 || $rec->tipo == 6 || $rec->tipo == 3)? $CongregacionController->set_miles($rec->valor) : "" }}</td>
          <td>{{ ($rec->tipo == 2 || $rec->tipo == 4)? $CongregacionController->set_miles($rec->valor) : "" }}</td>
          <td style="text-transform: capitalize">{{ substr($rec->descripcion, 0, 50) }}</td>
          <td>{{ ($rec->tipo == 6)? $CongregacionController->set_miles($rec->valor) : "" }}</td>
          <td>{{ ($rec->tipo == 2 || $rec->tipo == 4)? $CongregacionController->set_miles($rec->valor) : "" }}</td>
          <td>{{ ($rec->tipo == 3)? $CongregacionController->set_miles($rec->valor) : "" }}</td>
          <td>{{ ($rec->tipo == 1)? $CongregacionController->set_miles($rec->valor) : "" }}</td>
          <td></td>
        </tr>
      @endforeach
      @for($i = 0; $i < $celdasVacias; $i++)
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      @endfor
      <tr>
        <td></td>
        <td>{{ $CongregacionController->set_miles($totalConsignaciones) }}</td>
        <td class="negro"></td>
        <td>{{ $CongregacionController->set_miles($sumResolucionObra) }}</td>
        <td style="white-space: nowrap">TOTAL REMESA DE DONACIONES (S-20-S)</td>
        <td class="negro"></td>
        <td class="negro"></td>
        <td>{{ $CongregacionController->set_miles($totalResolucionSalones) }}</td>
        <td>{{ $CongregacionController->set_miles($totalObraMundial) }}</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td class="negro"></td>
        <td>{{ $CongregacionController->set_miles($totalEntrada) }}</td>
        <td>{{ $CongregacionController->set_miles($totalSalida) }}</td>
        <td>TOTAL INGRESOS Y GASTOS</td>
        <td>{{ $CongregacionController->set_miles($totalCaja) }}</td>
        <td>{{ $CongregacionController->set_miles($totalGastos) }}</td>
        <td class="negro"></td>
        <td class="negro"></td>
        <td class="negro"></td>
      </tr>
      <tr>
        <td colspan="2" style="text-transform: lowercase">Deben efectuar los depositos a la sucursal quincenalmente</td>
        <td>{{ $CongregacionController->set_miles($cajaFinal1) }}</td>
        <td colspan="2">SALDO A FIN DE MES</td>
        <td>{{ $CongregacionController->set_miles($cajaFinal2) }}</td>
        <td style="text-transform: lowercase">Total del saldo D debe ser igual a B.</td>
        <td colspan="3"></td>
      </tr>
      <tr>
        <td class="letraFinal" colspan="2">A</td>
        <td class="letraFinal">B</td>
        <td class="letraFinal" colspan="2">C</td>
        <td class="letraFinal">D</td>
        <td class="letraFinal">E</td>
        <td class="letraFinal">F</td>
        <td class="letraFinal">G</td>
        <td class="letraFinal">H</td>
      </tr>
    </table>
</div>

<!-- Inicio pagina 2 -->
<div style="margin-bottom: 20px;">
  <br><br><br><br><br><br>
      <style>
      .row{
        display: inline-block;
        width: 49%;
      }
      .row .container{
        border: 1px solid #000;
        width: 80%;
        display: block;
        margin: 0 auto;
        padding: 15px;
        min-height: 420px;
      }
      .row .inline{
        display: inline-block;
      }
      .row .border-bottom{
        border-bottom: 1px solid #000;
      }
      .row .border-bottom-double{
        border-bottom: 1px double #000;
      }
      .text-right{
        text-align: right;
      }
      .capitalize{
        text-transform: capitalize;
      }
      </style>
      <div style="margin-top: 120px">
      <div class="row">
          <div class="container">
            <h2 style="text-align: center">CONCILIACIÓN DE LAS CUENTAS</h2>
            <br>
            <div class="inline" style="width: 60%">PARA EL MES QUE TERMINA EL:</div><div class="inline border-bottom" style="width: 38%;min-height: 15px;">{{ $finalizacionMes }}</div>
            <br><br>
            <div>FONDOS PARA LA CONGREGACIÓN</div>
            <br>
            <div class="inline capitalize" style="width: 60%">Saldo anterior (columna D)</div><div class="inline border-bottom" style="width: 38%;min-height: 15px;text-align: right">${{ $CongregacionController->set_miles($inicioMes) }}</div><br>
            <br>
            <div class="inline capitalize" style="width: 65%">Dinero Recibido (columna D - saldo anterior)</div><div class="inline border-bottom" style="width: 33%;min-height: 15px;text-align: right">{{ $CongregacionController->set_miles($totalEntradaCongregacion) }}</div><br>
            <br>
            <div class="inline capitalize" style="width: 60%">Gastos de la Congregación (columna E)</div><div class="inline border-bottom" style="width: 38%;min-height: 15px;text-align: right">{{ $CongregacionController->set_miles($totalGastos) }}</div><br>
            <br>
            <div class="inline capitalize" style="width: 60%">Saldo restante</div><div class="inline border-bottom-double" style="width: 38%;min-height: 15px;text-align: right">${{ $CongregacionController->set_miles($cajaFinal2) }}</div><br>
            <br><br>
            <p style="text-transform: none">Este cuadro permite conciliar tato los fondos de la congregación como la cuenta bancaria, en caso de que la congregación posea una. El saldo restante debe ser igual a la cantidad de dinero que la congregación tiene para el último día del mes.</p>
            <br>
            <p style="text-transform: none">Nota: Los "saldos restantes" de la columna de arriba deben anotarse en la siguiente Conciliación de las cuentas como "saldo anterior".</p>
          </div>
      </div>
      <div class="row">
        <div class="container">
          <h2 style="text-align: center">OBLIGACIONES A FIN DE MES</h2>
          <p>Actuales:</p>
          @foreach($lstGastos as $itemGasto)
            <div class="inline border-bottom" style="width: 55%;text-transform: capitalize">{{ substr($itemGasto->descripcion, 0, 68) }}</div><div class="inline border-bottom" style="width: 35%; margin-left: 8%; text-align: right">${{ $CongregacionController->set_miles($itemGasto->valor) }}</div><br>
          @endforeach
          @for($i = 0; $i < $celdasVaciasGastos; $i++)
            <div class="inline border-bottom" style="width: 55%;"></div><div class="inline border-bottom" style="width: 35%; margin-left: 8%"></div><br>
          @endfor
            <br>
            <div class="inline" style="width: 55%;text-align: right">Total</div><div class="inline border-bottom" style="width: 35%; margin-left: 8%;text-align: right">${{ $CongregacionController->set_miles($totalGastos) }}</div>

            <p>a largo plazo:</p>
            @for($i = 0; $i < 5; $i++)
              <div class="inline border-bottom" style="width: 55%;"></div><div class="inline border-bottom" style="width: 35%; margin-left: 8%"></div><br>
            @endfor
              <br>
              <div class="inline" style="width: 55%;text-align: right">Total</div><div class="inline border-bottom" style="width: 35%; margin-left: 8%"></div>


        </div>
      </div>
    </div>
</div>



  </body>
</html>
