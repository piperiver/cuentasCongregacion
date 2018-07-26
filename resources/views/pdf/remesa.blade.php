@inject('CongregacionController', 'App\Http\Controllers\CongregacionController')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Remesa</title>
    <style>
      body{
        padding: 10px 50px;
      }
      .title{
        font-size: 18px;
        font-weight: bold;
      }
      .text-center{
        text-align: center;
      }
      .label{
        font-size: 14px;
        font-weight: bold;
      }
      *{
        font-size: 16px;
      }
      .uppercase{
        text-transform: uppercase;
      }
      .container-items{
        margin-top: 15px;
        width: 100%;
      }
      .container-items .text, .container-items .dotted, .container-items .number{
        display: inline-block;
        min-height: 19px;
      }
      .container-items .text{
        white-space: nowrap;
      }
      .container-items .number{
        width: 10%;
      }
      .container-items .number .dollar{
        display: inline-block;
        width: 10%;
      }
      .container-items .number .value{
        display: inline-block;
        width: 87%;
        border-bottom: 1px solid #000;
        text-align: center;
      }
      .margin-top-10{
        margin-top: 10px;
      }
      .margin-top-15{
        margin-top: 15px;
      }
      .margin-top-20{
        margin-top: 20px;
      }
      .footerPage1 {
        position: fixed;
        bottom: 0px;
        left: 0px;
        right: 0px;
        height: 50px;
        margin-bottom: 25px;
      }
    </style>
  </head>
  <body>
    <div><!-- Inicio pagina 1 -->
      <h4 class="text-center title">FORMULARIO DE REMESA DE DONACIONES</h4>
      <div style="width: 100%">
        <div style="display: inline-block; width: 80%; border-bottom: 1px solid #000; margin-right: 4%">
          <div style="width: 60%; display: inline-block; height: 18px;" class="uppercase">{{ $infoCongregacion->nombre }}</div>
          <div style="width: 44%; display: inline-block; height: 18px;" class="uppercase">{{ $mesAnnio }}</div>
        </div>
        <div style="width: 15%; display: inline-block; height: 25px;border: 1px solid #000; text-align: center">{{ $infoCongregacion->codigo }}</div>
      </div>
      <div style="width: 100%; margin-top: 2px;">
        <div style="display: inline-block; width: 80%;margin-right: 4%">
          <div style="width: 60%; display: inline-block; height: 18px;"><label class="label">Nombre de la congregación</label></div>
          <div style="width: 44%; display: inline-block; height: 18px;"><label class="label">Fecha</label></div>
        </div>
        <div style="width: 15%; display: inline-block; height: 18px;text-align: center"><label class="label">Núm. de congregación</label></div>
      </div>

      <div style="width: 100%">
        <div style="display: inline-block; width: 80%; border-bottom: 1px solid #000; margin-right: 4%">
          <div style="width: 60%; display: inline-block; height: 18px;" class="uppercase">Cali</div>
          <div style="width: 44%; display: inline-block; height: 18px;" class="uppercase">Valle del Cauca</div>
        </div>
      </div>
      <div style="width: 100%; margin-top: 2px;">
        <div style="display: inline-block; width: 80%;margin-right: 4%">
          <div style="width: 60%; display: inline-block; height: 18px;"><label class="label">Ciudad</label></div>
          <div style="width: 44%; display: inline-block; height: 18px;"><label class="label">Departamento</label></div>
        </div>
      </div>

      <h2 style="text-align: left">Donaciones para:</h2>

      <div style="width: 100%; padding-left: 15px;" class="margin-top-20"><!-- Container descripcion -->
        <div class="container-items">
          <div class="text" style="width: 11%">"Obra del Reino"</div>
          <div class="dotted" style="width: 78%"><span style="display: inline-block;width: 100%;border-bottom: 1px dotted #000;margin-top: -3px"></span></div>
          <div class="number"><span class="dollar">$</span><span class="value">{{ $CongregacionController->set_miles($totalObraMundial) }}</span></div>
        </div>
        <div class="container-items">
          <div class="text" style="width: 60%">"Construcción mundial de Salones del Reino" (Incluye resolución de la congregación)</div>
          <div class="dotted" style="width: 29%"><span style="display: inline-block;width: 100%;border-bottom: 1px dotted #000;margin-top: -3px"></span></div>
          <div class="number"><span class="dollar">$</span><span class="value">{{ $CongregacionController->set_miles($totalResolucionSalones) }}</span></div>
        </div>
        <div class="container-items">
          <div class="text" style="width: 42%">Programa de asistencia para los Salones del Reino (KHAA)</div>
          <div class="dotted" style="width: 47%"><span style="display: inline-block;width: 100%;border-bottom: 1px dotted #000;margin-top: -3px"></span></div>
          <div class="number"><span class="dollar">$</span><span class="value"></span></div>
        </div>
        <div class="container-items">
          <div class="text" style="width: 9%">Sonido para:</div>
          <div style="display: inline-block; width: 20%; height: 18px">
            <span style="width: 23px;height: 16px;display: inline-block;border: 1px solid #000;"></span>
            <span style="width: 42%;display: inline-block;">Circuito #</span>
            <span style="width: 37%;height: 18px;border-bottom: 1px solid #000;display: inline-block;"></span>
          </div>
          <div style="display: inline-block; width: 13%; height: 18px; padding-left: 5px;">
            <span style="width: 23px;height: 16px;display: inline-block;border: 1px solid #000;margin-bottom: -3px;"></span>
            <span style="width: 79%;display: inline-block;">Congregación</span>
          </div>
          <div class="dotted" style="width: 45.5%"><span style="display: inline-block;width: 100%;border-bottom: 1px dotted #000;margin-top: -3px"></span></div>
          <div class="number"><span class="dollar">$</span><span class="value"></span></div>
        </div>
        <div class="container-items">
          <div class="text" style="width: 29%;">Otras donaciones (Por favor especifique):</div>
          <div class="dotted" style="width: 60%"><span style="display: inline-block;width: 100%;border-bottom: 1px solid #000;margin-top: -3px"></span></div>
          <div class="number"><span class="dollar">$</span><span class="value"></span></div>
        </div>
        <div class="container-items">
          <div class="dotted" style="width: 89.35%"><span style="display: inline-block;width: 100%;border-bottom: 1px solid #000;margin-top: -3px"></span></div>
          <div class="number"><span class="dollar">$</span><span class="value"></span></div>
        </div>
        <div class="container-items">
          <div class="text" style="width: 5%;"><strong>Banco:</strong></div>
          <div class="dotted" style="width: 25%"><span style="display: inline-block;width: 100%;border-bottom: 1px solid #000;margin-top: -3px; text-align: center">Banco de Bogotá</span></div>
          <div class="text" style="width: 5%;margin-left: 53.5%"><strong>Total:</strong></div>
          <div class="number"><span class="dollar">$</span><span class="value">{{ $CongregacionController->set_miles($total) }}</span></div>
        </div>
      </div><!-- Fin container descripcion -->

      <div class="container-items">
        <div class="text" style="width: 9%;"><strong>Adjuntamos:</strong></div>
        <div class="dotted" style="width: 30%"><span style="display: inline-block;width: 100%;border-bottom: 1px solid #000;margin-top: -3px;text-align: center">{{ $numeroHojasConsignacion }}</span></div>
      </div>
      <div class="container-items" style="margin-top: 0">
        <div class="text" style="width: 9%;"><strong></strong></div>
        <div class="dotted" style="width: 30%; font-size: 12px; text-align: center;margin-top: -7px">Número de hojas de consignación</div>
      </div>
      <div style="width: 85%; margin: 0 auto; border: 1px solid #000; padding: 5px;">
        Por favor enviar este formulario de remesa junto con los recibos de consignación quincenal de las donaciones de la congregación.
        Envíen el original por correo para el día seis de cada mes y guarden la copia en el archivo.
      </div>
      <br>
      <div style="position: absolute; bottom: 0;width: 100%;margin-bottom: 10px  ">
        <div style="width: 49%; display: inline-block">
          <div style="width: 70%; border-bottom: 1px solid #000;"></div>
          <div><strong>Siervo de cuentas</strong></div>
        </div>
        <div style="width: 49%; display: inline-block">
          <div style="width: 70%; border-bottom: 1px solid #000;"></div>
          <div><strong>Secretario</strong></div>
        </div>
      </div>
      <footer style="position: absolute; bottom: 0;width: 100%;">
        <span style="float: left; font-size: 12px">FC-B S-20-S Col. 5/09</span>
    </footer><!-- Fin contenedor primera pagina -->
    </div><!-- Fin pagina 1 -->
  </body>
</html>
