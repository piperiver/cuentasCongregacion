@inject('CongregacionController', 'App\Http\Controllers\CongregacionController')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Informe Mensual{{ $CongregacionController->set_miles($sobrante) }}</title>
    <style>
      .text-center{
        text-align: center;
      }
      p, strong, em, p, span{
        font-size: 16px;
        line-height: 1;
      }
      .border-bootom{
        border-bottom: 1px solid #000000;
        padding: 0 8px;
      }

      .san-serif{
        font-family: Sans-Serif;
      }
      .bold{
        font-weight: bold;
      }
      .inline{
        display: inline-block;
      }
      .marginX0{
        margin: 0;
      }
      .tbl{
        width: 100%;
        border-spacing: 2px;
      }
      .tbl .standard{
        height: 15px;
        width: 15%;
      }
      .tbl .spacing{
        width: 5px;
      }
      .tbl .maxima{
        width: 35%;
        height: 15px;
      }
      .text-left{
        text-align: left;
      }
      .border-bootom{
        border-bottom: 1px solid #000;
      }
      #tbl_congregacion{
        width: 100%
      }
      #tbl_congregacion .label{
        width: 10%;
      }
      #tbl_congregacion .largo{
        width: 47%;
      }
      #tbl_congregacion .corto{
        width: 33%;
      }
      .text-justify{
        text-align: justify;
      }
      .title{
        font-size: 18px;
        font-weight: bold;
      }
      caption{
        font-size: 14px;
      }
      .subtitle{
        font-size: 14px;
      }
      h4{
        margin: 10px 0;
      }
      .underline{
        text-decoration: underline;
      }
      .container-dollar{
        width: 8%;
        margin-top: 1px;
        display: inline-block;
      }

      .container-number{
        display: inline-block;
        width: 77%;
        padding-left: 3px;
        border-bottom: 1px solid #000;
      }
      .container-text{
        display: inline-block;
        width: 100%;
        padding-left: 3px;
        border-bottom: 1px solid #000;
      }

      .container-fila{
        width: 100%;
        display: block;
      }
      .columna1{
        display: inline-block;
        width: 40%;
        padding-left: 17px;
      }
      .sinPaddingLeft{
        padding-left: 0;
      }
      .columnaX2{
        display: inline-block;
        width: 49%;
        padding-left: 17px;
      }
      .columnaX3{
        display: inline-block;
        width: 62%;
        padding-right: 13px;
      }
      .columnaX4{
        display: inline-block;
        width: 77%;
        padding-right: 13px;
      }
      .texto-columna1{
        border-bottom: 1px solid #000;
        width: 100%;
        display: block;
      }
      .sin-border-bottom{
        border-bottom: none !important;
      }
      .columnaEspacio{
        display: inline-block;
        width: 5%;
      }
      .numero-columnas{
        display: inline-block;
        width: 16%;
        margin-top: 3.7px;
      }
      .columna-centro{
        margin-left: 15px;
        margin-right: 15px;
      }
      .container-pesos{
        display: inline-block;
        width: 8%;
      }
      .container-valor{
        display: inline-block;
        width: 76%;
        border-bottom: 1px solid #000;
      }
      .container-letra{
          display: inline-block;
          width: 10%;
      }
      .footerPage1 {
        position: fixed;
        bottom: 0px;
        left: 0px;
        right: 0px;
        height: 50px;
        margin-bottom: 25px;
      }
      .margin-top-20{
        margin-top: 20px;
      }
      .cuadroNota{
        font-size: 10px !important;
        border: 1px solid #000;
        padding: 3px;
        width: 14.6%;
        height: auto;
        position: absolute;
        right: 0;
        top: 60%;
        line-height: 1;

      }
      .cuadroNota strong{
        font-size: 10px;
      }
      .resumen-linea{
        border-bottom: 1px solid #000;
        text-transform: uppercase;
        display: inline-block;
        width: 100px;
        line-height: 1.35;
        text-align: center;
      }
      .uppercase{
        text-transform: uppercase;
      }
    </style>
  </head>
  <body>
    <div><!-- Inicio contenedor primera pagina -->
      <h4 class="text-center title">INFORME MENSUAL DE LAS CUENTAS DE LA CONGREGACIÓN</h4>
      <p class="text-justify"><strong>Instrucciones:</strong> Antes de la segunda Reunión de Servicio de cada mes, el siervo de cuentas preparara este
        informe y le dara un copia al coordinador del cuerpo de ancianos, quien revisara el anuncio que aparece en la pagina 2.
        El siervo de cuentas debe archivar el informe en su version original en el archivo actual con la <em>Hoja de cuentas</em> (S-26).
      </p>
      <table id="tbl_congregacion" style="">
        <tr>
          <td class="label">Congregación:</td>
          <td class="largo border-bootom uppercase">{{ $infoCongregacion->nombre }}</td>
          <td class="label">Mes/año:</td>
          <td class="corto border-bootom">{{ $mesAnnio }}</td>
        </tr>
      </table>
      <br>
      <h4 class="text-center san-serif bold subtitle" style="margin: 22px 0">INFORME FINANCIERO DE LA CONGREGACIÓN</h4>
      <div style="width: 100%;margin-top: 35px">
        <div style="width: 38%" class="inline">
          <p class="marginX0">Fondos de la congregación</p>
          <p class="marginX0">a comienzo de mes</p>
        </div>
        <div style="width: 40%; border: 1px solid #000; padding: 2px; font-size: 10px; margin-right: 2%" class="inline">
          Esta cifra debe ser la misma que la que se encuentra en el apartado "Fondos de la congregación a fin de mes" [cifra(e)].
          que aparece en el informe financiero de la congregación del mes anterior
        </div>
        <div style="width: 18%;" class="inline">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($inicioMes) }}</span>
          <span class="container-letra">(a)</span>
        </div>
      </div>
      <br>
    <div><!-- Recibido por la congregacion -->
      <h4 class="san-serif bold subtitle">RECIBIDO POR LA CONGREGACIÓN:</h4>
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1">CAJA CONGREGACIÓN</span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalEntradaCongregacion) }}</span>
        </div>
      </div>
      @for($i = 0; $i < 4; $i++)
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1"></span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor"></span>
        </div>
      </div>
      @endfor
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1 sin-border-bottom">Total recibido</span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
        </div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalEntradaCongregacion) }}</span>
          <span class="container-letra">(b)</span>
        </div>
      </div>
    </div><!-- Fin recibido por la congregacion -->

    <div><!-- Gastos de la congregacion -->
      <h4 class="san-serif bold subtitle">GASTOS DE LA CONGREGACIÓN:</h4>
      @foreach($lstGastos as $gasto)
        <div class="container-fila">
          <div class="columna1"><span class="texto-columna1">{{ $gasto->descripcion }}</span></div>
          <div class="columnaEspacio"></div>
          <div class="numero-columnas">
            <span class="container-pesos">$</span>
            <span class="container-valor">{{ $CongregacionController->set_miles($gasto->valor) }}</span>
          </div>
        </div>
      @endforeach
      @for($i = 0; $i < $celdasVaciasGastos; $i++)
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1"></span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor"></span>
        </div>
      </div>
      @endfor
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1 sin-border-bottom">Total de gastos</span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
        </div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalGastos) }}</span>
          <span class="container-letra">(c)</span>
        </div>
      </div>
      <div class="container-fila">
        <div class="columna1 sinPaddingLeft"><span class="texto-columna1 sin-border-bottom">Sobrante (déficit)[(b)-(c)]</span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas"></div>
        <div class="numero-columnas"></div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($sobrante) }}</span>
          <span class="container-letra">(d)</span>
        </div>
      </div>
      <div class="container-fila">
        <div class="columnaX4"><span class="texto-columna1 sin-border-bottom">Fondos de la congregación a fin de mes [(a)+(d)] (transfiéralos al mes siguiente)</span></div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($fondosFinMes) }}</span>
          <span class="container-letra">(e)</span>
        </div>
      </div>
    </div><!-- Gastos de la congregacion -->

    <div><!-- Fondos reservados para uso especial -->
      <h4 class="san-serif bold subtitle">FONDOS DE LA CONGREGACIÓN RESERVADOS PARA USO ESPECIAL:</h4>
      @for($i = 0; $i < 3; $i++)
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1"></span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
          <span class="container-pesos">{{ ($i == 0)? "$" : "" }}</span>
          <span class="container-valor"></span>
        </div>
      </div>
      @endfor
      <div class="container-fila">
        <div class="columnaX3"><span class="texto-columna1 sin-border-bottom">Total de los fondos reservados para uso especial</span></div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor"></span>
          <span class="container-letra">(f)</span>
        </div>
      </div>
      <br>
      <div class="container-fila">
        <div class="columnaX4"><span class="texto-columna1 sin-border-bottom">Fondos disponibles para cubrir los gastos de la congregación [(e)-(f)] </span></div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($fondosFinMes) }}</span>
          <span class="container-letra">(g)</span>
        </div>
      </div>
    </div><!-- Fin Fondos reservados para uso especial -->
    <br>
    <footer class="footerPage1">
      <span style="float: left">S-30-S Co 3/13</span>
      <span style="float: right">Impreso en Colombia</span>
  </footer><!-- Fin contenedor primera pagina -->
</div>
<!-- PAGINA 2 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
  <div>
    <h4 class="text-center san-serif bold subtitle">CONCILIACIÓN</h4>
    <div style="width: 100%" class="margin-top-20">
      <div style="width: 36%" class="inline">
        <p class="marginX0">Total de los fondos a comienzo de mes</p>
      </div>
      <div style="width: 40%; border: 1px solid #000; padding: 2px; font-size: 10px; margin-right: 3.5%; vertical-align: middle" class="inline">
        Esta cifra debe ser la misma que la que se encuentra en el apartado "Total de los fondos a fin de mes"[cifra (m)],
        que aparece en la conciliación del mes anterior.
      </div>
      <div style="width: 18%;" class="inline">
        <span class="container-pesos">$</span>
        <span class="container-valor">{{ $CongregacionController->set_miles($inicioMes) }}</span>
        <span class="container-letra">(h)</span>
      </div>
    </div>
    <div><!-- Recibido -->
      <h4 class="san-serif bold subtitle">RECIBIDO:</h4>
      <div class="container-fila">
        <div class="columnaX2"><span class="texto-columna1 sin-border-bottom">Recibido por la congregación [total(b) de la página 1]</span></div>
        <div class="numero-columnas">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalEntradaCongregacion) }}</span>
        </div>
      </div>
      <p style="margin: 3px 0;padding-left: 17px;">Recibido de las cajas de contribuciones:</p>
      <div class="container-fila">
        <div class="columnaX2"><span class="texto-columna1 sin-border-bottom" style="padding-left: 17px;">para la obra mundial</span></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalObraMundial) }}</span>
        </div>
      </div>
      <div class="container-fila">
        <div class="columnaX2"><span class="texto-columna1 sin-border-bottom" style="padding-left: 17px;">para la construcción mundial de Salones del Reino</span></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor"></span>
        </div>
      </div>
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1"></span></div>
        <div style="display: inline-block; width: 8.4%;"></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor"></span>
        </div>
      </div>

      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1 sin-border-bottom">Total recibido</span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
        </div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalRecibido) }}</span>
          <span class="container-letra">(i)</span>
        </div>
      </div>
    </div><!-- Fin recibido  -->

    <div><!-- DESEMBOLSOS -->
      <h4 class="san-serif bold subtitle">DESEMBOLSOS:</h4>
      <div class="container-fila">
        <div class="columnaX2"><span class="texto-columna1 sin-border-bottom">Gastos de la congregación [total(c) de la página 1]</span></div>
        <div class="numero-columnas">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalGastos) }}</span>
        </div>
      </div>
      <p style="margin: 3px 0;padding-left: 17px;">Enviado de las cajas de contribuciones:</p>
      <div class="container-fila">
        <div class="columnaX2"><span class="texto-columna1 sin-border-bottom" style="padding-left: 17px;">para la obra mundial</span></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalObraMundial) }}</span>
          <span class="container-letra">(j)</span>
        </div>
      </div>
      <div class="container-fila">
        <div class="columnaX2"><span class="texto-columna1 sin-border-bottom" style="padding-left: 17px;">para la construcción mundial de Salones del Reino</span></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor"></span>
          <span class="container-letra">(k)</span>
        </div>
      </div>
      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1"></span></div>
        <div style="display: inline-block; width: 8.4%;"></div>
        <div class="numero-columnas">
          <span class="container-pesos"></span>
          <span class="container-valor"></span>
        </div>
      </div>

      <div class="container-fila">
        <div class="columna1"><span class="texto-columna1 sin-border-bottom">Total de desembolsos</span></div>
        <div class="columnaEspacio"></div>
        <div class="numero-columnas">
        </div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($totalDesembolsos) }}</span>
          <span class="container-letra">(l)</span>
        </div>
      </div>
      <br><br>
      <div class="container-fila">
        <div class="cuadroNota">Nota: Esta cantidad debe ser igual a la del "Total de los fondos a fin de mes" del recuadro <strong>"Conciliación de la hoja de cuentas"</strong>
        (S-26), y a la cantidad de "Fondos de la congregación a fin de mes" (e), de la página 1.</div>
        <div class="fa fa-arrow-circle-o-down"></div>
        <div class="columnaX4" style="width: 80%;"><span class="texto-columna1 sin-border-bottom">Total de los fondos a fin de mes [(h)+(i)-(l)] (transfiéralos al mes siguiente)</span></div>
        <div class="numero-columnas columna-centro">
          <span class="container-pesos">$</span>
          <span class="container-valor">{{ $CongregacionController->set_miles($fondosFinMes2) }}</span>
          <span class="container-letra">(m)</span>
        </div>
      </div>
    </div><!-- Fin DESEMBOLSOS -->
    <div style="width: 100%">
      <div style="width: 36%;display: inline-block;text-align: right;">Siervo de cuentas:</div>
      <div style="width: 65%;display: inline-block;">
        <div style="height: 18px;border-bottom: 1px solid #000;"></div>
      </div>
      <div style="font-size: 15px;width: 65%;text-align: center;float: right;margin-top: -15px">(Firma y nombre legible)</div>
    </div>
    <br>
    <h4 class="text-center" style="font-size: 18px;margin: 0; padding: 0;margin-top: 5px;">ANUNCIO MENSUAL DE LAS CUENTAS DE LA CONGREGACIÓN</h4>
    <p style="text-align: justify; font-size: 17px;padding-bottom: 5px;border-bottom: 1px solid #000; margin-bottom: 0">
      <strong style="font-size: 17px;">Instrucciones:</strong> Este anuncio debe leerse a la congregación en la segunda Reunión de Servicio de cada mes por el hermano encargado
      de la primera parte de esa semana. Si no es posible leerlo (por ejemplo, porque la congregación tiene asamblea esa semana), puede hacerse el anuncio
      la semana siguiente. No deben leerse a la congregación estas instrucciones ni la información que está entre paréntesis.
    </p>
    <p style="margin: 0; padding-bottom: 5px;border-bottom: 1px solid #000;line-height: 2.3">
      En el mes de <span class="resumen-linea">{{ $mes }}</span>,
       la congregación recibió un total de $<span class="resumen-linea">{{ $CongregacionController->set_miles($totalEntradaCongregacion) }}</span>.
       Los gastos de la congregación ascendieron a $<span class="resumen-linea">{{ $CongregacionController->set_miles($totalGastos) }}</span>.
       Esto dejó un balance final de mes de $<span class="resumen-linea">{{ $CongregacionController->set_miles($fondosFinMes) }}</span>.
       Además, la congregación envió las donaciones de las cajas de contribuciones a la sucursal. Las cifras son las siguientes:
       $<span class="resumen-linea">{{ $CongregacionController->set_miles($totalObraMundial) }}</span>
       para la obra mundial y $<span class="resumen-linea">{{ $CongregacionController->set_miles($totalResolucionSalones) }}</span>
       para la construccion mundial de Salones del Reino. Se colocará una copia del <em>Informe mensual de las cuentas de la congregación</em> en el tablero de anuncios.
    </p>
    <p style="margin: 5px">
      (Despúes de los anuncios, devuelva este informe al coordinador del cuerpo de ancianos para que él lo coloque en el tablero de anuncios.)
    </p>
    <!--<p style="margin: 0">
      <span style="visibility: hidden">En el mes de </span><span style="text-align: center; display: inline-block; width: 100px; font-size: 10px;">(Mes pasado)</span>
      <span style="visibility: hidden">, la congregación recibió un total de $</span><span style="text-align: center; display: inline-block; width: 100px; font-size: 10px;">[Cifra(b)]</span>
      <span style="visibility: hidden">. Los gastos de la congregación ascendieron a $</span><span style="text-align: center; display: inline-block; width: 100px; font-size: 10px;">[Cifra(c)]</span>
    </p>-->
    <footer class="footerPage1">
      <span style="float: left; position: absolute">S-30-S Co 3/13</span>
      <span style="margin: 0 auto; display: block; width: 20px; text-align: center">2</span>
  </footer><!-- Fin contenedor primera pagina -->
  </div><!-- Fin Page -->

  </body>
</html>
