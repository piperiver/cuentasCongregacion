<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Congregacion;
use App\Recibo;
use App\Carpeta;
use App\Constantes;
use App\User;
use App\Permisos_user;
use DB;
use PDF;

class CongregacionController extends Controller{

  var $keyPermisos = "permisosCuentas";

  var $nombreMeses = [
                      "1" => "ENERO",
                      "2" => "FEBRERO",
                      "3" => "MARZO",
                      "4" => "ABRIL",
                      "5" => "MAYO",
                      "6" => "JUNIO",
                      "7" => "JULIO",
                      "8" => "AGOSTO",
                      "9" => "SEPTIEMBRE",
                      "10" => "OCTUBRE",
                      "11" => "NOVIEMBRE",
                      "12" => "DICIEMBRE"
                    ];

  var $tiposRecibos = [
                      "1" => "Obra Mundial",
                      "2" => "Gastos",
                      "3" => "Resolucion Salones",
                      "4" => "Mi Circuito",
                      "5" => "Cosignaci&oacute;n Bancaria",
                      "6" => "Entrada Congregaci&oacute;n"
                      ];
   var $meses_ingles = array(
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December"
                            );
    var $meses_espanol = array(
                          'Enero',
                          'Febrero',
                          'Marzo',
                          'Abril',
                          'Mayo',
                          'Junio',
                          'Julio',
                          'Agosto',
                          'Septiembre',
                          'Octubre',
                          'Noviembre',
                          'Diciembre',
                          );
   var $dias_ingles = [
                      "Monday",
                      "Tuesday",
                      "Wednesday",
                      "Thursday",
                      "Friday",
                      "Saturday",
                      "Sunday"
   ];

   var $dias_espanol = [
     "Lunes",
     "Martes",
     "Miercoles",
     "Jueves",
     "Viernes",
     "Sabado",
     "Domingo"
   ];

    function verHtmlPdf(){
      return view('pdf.hojaCuentas');
    }
    function informeMensual($idCarpeta){
      $infoCarpeta = Carpeta::find($idCarpeta);
      if(isset($infoCarpeta->id)){
        $infoCongregacion = Congregacion::find($infoCarpeta->idCongregacion);
        $recibo = Recibo::where("idCarpeta", $idCarpeta)->orderBy("fecha")->get();

        $inicioMes = $this->getInicioMes($infoCarpeta->annio, $infoCarpeta->mes);

        $mesAnnio = $this->nombreMeses[$infoCarpeta->mes]." / ".$infoCarpeta->annio;

        $totalEntradaCongregacion = $recibo->where("tipo", "6")->sum("valor");

        $lstGastos = $recibo->whereIn("tipo", ["2", "4"]);
        $totalGastos = $recibo->whereIn("tipo", ["2", "4"])->sum("valor");
        $celdasVaciasGastos = 8 - count($lstGastos);

        $sobrante = $totalEntradaCongregacion - $totalGastos;
        $fondosFinMes = $inicioMes + $sobrante;

        $totalObraMundial = $recibo->where("tipo", "1")->sum("valor");
        $totalRecibido = $totalObraMundial + $totalEntradaCongregacion;

        $totalDesembolsos = $totalObraMundial + $totalGastos;

        $fondosFinMes2 = $inicioMes + $totalRecibido - $totalDesembolsos;

        $mes = $this->nombreMeses[$infoCarpeta->mes];
        $totalResolucionSalones = $recibo->where("tipo", "3")->sum("valor");

        $pdf = PDF::loadView('pdf.informeMensual', compact("infoCarpeta",
                                                            "infoCongregacion",
                                                            "totalEntradaCongregacion",
                                                            "lstGastos",
                                                            "celdasVaciasGastos",
                                                            "totalGastos",
                                                            "sobrante",
                                                            "fondosFinMes",
                                                            "totalObraMundial",
                                                            "totalRecibido",
                                                            "totalDesembolsos",
                                                            "fondosFinMes2",
                                                            "mes",
                                                            "totalResolucionSalones",
                                                            "inicioMes",
                                                            "mesAnnio"))->setPaper('a4', 'portrait');
        return $pdf->stream();
      }
    }
    function hojadeCuentas($idCarpeta){
      $infoCarpeta = Carpeta::find($idCarpeta);
      if(isset($infoCarpeta->id)){

        $infoCongregacion = Congregacion::find($infoCarpeta->idCongregacion);
        $recibo = Recibo::where("idCarpeta", $idCarpeta)->orderBy("fecha")->get();

        $totalObraMundial = $recibo->where("tipo", "1")->sum("valor");
        $totalResolucionSalones = $recibo->where("tipo", "3")->sum("valor");
        $totalGastos = $recibo->whereIn("tipo", ["2", "4"])->sum("valor");
        $totalEntradaCongregacion = $recibo->where("tipo", "6")->sum("valor");
        $totalConsignaciones = $recibo->where("tipo", "5")->sum("valor");

        $inicioMes = $this->getInicioMes($infoCarpeta->annio, $infoCarpeta->mes);

        $sumResolucionObra = $totalResolucionSalones + $totalObraMundial;
        $totalEntrada = $inicioMes + $totalObraMundial + $totalResolucionSalones + $totalEntradaCongregacion;
        $totalSalida = $totalGastos + $sumResolucionObra;
        $totalCaja = $inicioMes + $totalEntradaCongregacion;
        $cajaFinal1 = $totalEntrada - $totalSalida;
        $cajaFinal2 = $totalCaja - $totalGastos;

        $mes = $this->nombreMeses[$infoCarpeta->mes];
        $day = date("d", mktime(0,0,0, $infoCarpeta->mes+1, 0, $infoCarpeta->annio));
        $finalizacionMes = $day. " de ".$this->nombreMeses[$infoCarpeta->mes]." del ".$infoCarpeta->annio;

        $celdasVacias = 28 - count($recibo);

        $lstGastos = $recibo->whereIn("tipo", ["2", "4"]);
        $celdasVaciasGastos = 10 - count($lstGastos);

        /*return view('pdf.hojaCuentas')->with("celdasVaciasGastos", $celdasVaciasGastos)
        ->with("lstGastos", $lstGastos)
        ->with("totalEntradaCongregacion", $totalEntradaCongregacion)
        ->with("finalizacionMes", $finalizacionMes)
        ->with("mes", $mes)
        ->with("infoCongregacion", $infoCongregacion)
        ->with("cajaFinal1", $cajaFinal1)
        ->with("cajaFinal2", $cajaFinal2)
        ->with("totalCaja", $totalCaja)
        ->with("totalSalida", $totalSalida)
        ->with("totalEntrada", $totalEntrada)
        ->with("sumResolucionObra", $sumResolucionObra)
        ->with("infoCarpeta", $infoCarpeta)
        ->with("totalResolucionSalones", $totalResolucionSalones)
        ->with("celdasVacias", $celdasVacias)
        ->with("recibo", $recibo)
        ->with("totalObraMundial", $totalObraMundial)
        ->with("totalGastos", $totalGastos)
        ->with("inicioMes", $inicioMes)
        ->with("totalConsignaciones", $totalConsignaciones);*/

        $pdf = PDF::loadView('pdf.hojaCuentas', compact("celdasVaciasGastos",
        "lstGastos",
        "totalEntradaCongregacion",
        "finalizacionMes",
        "mes",
        "infoCongregacion",
        "cajaFinal1",
        "cajaFinal2",
        "totalCaja",
        "totalSalida",
        "totalEntrada",
        "sumResolucionObra",
        "infoCarpeta",
        "totalResolucionSalones",
        "celdasVacias",
        "recibo",
        "totalObraMundial",
        "totalGastos",
        "inicioMes",
        "totalConsignaciones"))->setPaper('a4', 'landscape');
        return $pdf->stream();
      }
    }
    function remesa($idCarpeta){
      $infoCarpeta = Carpeta::find($idCarpeta);
      if(isset($infoCarpeta->id)){
        $infoCongregacion = Congregacion::find($infoCarpeta->idCongregacion);
        $recibo = Recibo::where("idCarpeta", $idCarpeta)->orderBy("fecha")->get();
        $mesAnnio = $this->nombreMeses[$infoCarpeta->mes]." / ".$infoCarpeta->annio;
        $totalObraMundial = $recibo->where("tipo", "1")->sum("valor");
        $totalResolucionSalones = $recibo->where("tipo", "3")->sum("valor");
        $total = $totalObraMundial + $totalResolucionSalones;
        $numeroHojasConsignacion = count($recibo->where("tipo", "5"));

        $pdf = PDF::loadView('pdf.remesa', compact("infoCarpeta",
                                                   "infoCongregacion",
                                                   "mesAnnio",
                                                   "totalResolucionSalones",
                                                   "total",
                                                   "numeroHojasConsignacion",
                                                   "totalObraMundial"))->setPaper('A4', 'landscape');
        return $pdf->stream();
      }
    }
    function desplegarVistaCongregacion($id){
      session(['idCongregacion' => $id]);
      $disponible = $this->getDisponibleHoy();
      $lastRecibo = DB::table('recibo')->orderBy('updated_at', 'desc')->first();
      if(isset($lastRecibo->updated_at)){
        $lastRecibo->updated_at =  strftime("%A %d %B %Y [%r]", strtotime($lastRecibo->updated_at));
        $lastRecibo->updated_at = str_replace($this->meses_ingles, $this->meses_espanol, $lastRecibo->updated_at);
        $lastRecibo->updated_at = str_replace($this->dias_ingles, $this->dias_espanol, $lastRecibo->updated_at);
      }else{
        $lastRecibo = false;
      }

      return view('inicio')->with("disponible", $disponible)->with("lastRecibo", $lastRecibo);
    }

    function guardarCarpeta(Request $request){

      $carpeta = Carpeta::where("mes", $request->mes)->where("annio", $request->annio)->get();
      if(count($carpeta) > 0){
          echo json_encode(["STATUS" => false, "messagge" => "Ya existe una carpeta para {$this->nombreMeses[$request->mes]} del {$request->annio}"]);
      }else{

          $carpeta = new Carpeta;
          $carpeta->idCongregacion = $request->idCongregacion;
          $carpeta->annio = $request->annio;
          $carpeta->mes = $request->mes;
          $carpeta->vlrInicioMes = $request->inicioMes;
          $carpeta->balance = $request->inicioMes;
          $result = $carpeta->save();


          if($result){
              $html = $this->buildMenu();
              echo json_encode(["STATUS" => true, "messagge" => "Carpeta Guardada Satisfactoriamente", "menu" => $html]);
          }else{
              echo json_encode(["STATUS" => false, "messagge" => "Ocurrio un error al intentar almadenar la carpeta, por favor intente de nuevo."]);
          }
      }

    }

    function buildMenu(){
      $congregacion = session('idCongregacion', false);
      if($congregacion == false){
        return "";
      }
      $carpetas = DB::table('carpeta')->where("carpeta.idCongregacion", $congregacion)->orderBy('carpeta.annio','desc')->orderBy('carpeta.mes','desc')->get();
      $annioActual = false;

      $arrayMaqueta = [];
      foreach ($carpetas as $carpeta) {
        $arrayMaqueta[$carpeta->annio][] =[
                                            "id" => $carpeta->id,
                                            "mes" => $carpeta->mes
                                          ];
      }

      $html = "";
      foreach ($arrayMaqueta as $key =>$infoAnnio) {
        $html .= '<li><a href="#"><i class="fa fa-table fa-fw"></i> '.$key.'<span class="fa arrow"></span></a>';
        if(count($infoAnnio) > 0){
          $html .= '<ul class="nav nav-second-level">';
          foreach ($infoAnnio as $infoMeses) {
            $html .= '<li><a href="'.config("constantes.URL_BASE").'carpeta/'.$infoMeses["id"].'"><i class="fa fa-folder-open"></i> '.$this->nombreMeses[$infoMeses["mes"]].'</a></li>';
          }
          $html .= '</ul>';
        }
        $html .= '</li>';
      }

      return $html;
    }

function calcularInicioMes(Request $request){
  if($request->mes - 1 >= 1){
    $carpeta = carpeta::where("annio", $request->annio)->where("mes", ($request->mes - 1))->first();
    $balance = (isset($carpeta->balance))? $carpeta->balance : false;
  }else{
    $carpeta = carpeta::where("annio", ($request->annio - 1))->where("mes", "12")->first();
    $balance = (isset($carpeta->balance))? $carpeta->balance : false;
  }

  echo json_encode(["balance" => $balance]);
}

function getNameCongregacion(){
  $congregacion = session('idCongregacion', false);
  if($congregacion == false){
    return "";
  }
  $searchCongregacion = Congregacion::find($congregacion);
  return $searchCongregacion->nombre. " - ".$searchCongregacion->codigo;
}

function getIdCongregacion(){
  return session('idCongregacion', false);
}

function getInicioMes($annio, $mes){
  $gastosGlobales = DB::table("recibo")->join("carpeta", "carpeta.id", "recibo.idCarpeta")->select(DB::raw('SUM(recibo.valor) as valores'))
                            ->where("carpeta.annio", "<=" , $annio)
                            ->where("carpeta.mes", "<", $mes)
                            ->whereIn("recibo.tipo", ["2", "4"])
                            ->get();
  $totalGastos = (count($gastosGlobales) > 0)? $gastosGlobales[0]->valores : 0;
  $entragaCongregacionGlobales = DB::table("recibo")->join("carpeta", "carpeta.id", "recibo.idCarpeta")->select(DB::raw('SUM(recibo.valor) as valores'))
                                      ->where("carpeta.annio", "<=" , $annio)
                                      ->where("carpeta.mes", "<", $mes)
                                      ->where("recibo.tipo", "6")
                                      ->get();
  $totalentrada  = (count($entragaCongregacionGlobales) > 0)? $entragaCongregacionGlobales[0]->valores : 0;
  $objConstante = Constantes::where("campo", "inicioMes")->get();
  $valorInicioMes = (count($objConstante) > 0)? $objConstante[0]->valor : 0;

  $inicioMes = $valorInicioMes + $totalentrada - $totalGastos;

  return $inicioMes;
}
function getDisponibleHoy(){

  $gastosGlobales = DB::table("recibo")->select(DB::raw('SUM(valor) as valores'))
                            ->whereIn("recibo.tipo", ["2", "4"])
                            ->get();
  $totalGastos = (count($gastosGlobales) > 0)? $gastosGlobales[0]->valores : 0;

  $entragaCongregacionGlobales = DB::table("recibo")->select(DB::raw('SUM(valor) as valores'))
                                      ->where("recibo.tipo", "6")
                                      ->get();
  $totalentrada  = (count($entragaCongregacionGlobales) > 0)? $entragaCongregacionGlobales[0]->valores : 0;
  $objConstante = Constantes::where("campo", "inicioMes")->get();
  $valorInicioMes = (count($objConstante) > 0)? $objConstante[0]->valor : 0;

  $disponible = $valorInicioMes + $totalentrada - $totalGastos;

  return $disponible;

}
function desplegarVistaCarpeta($idCarpeta){
  $infoCarpeta = Carpeta::find($idCarpeta);
  
  if(isset($infoCarpeta->id)){

    $recibo = Recibo::where("idCarpeta", $idCarpeta)->orderBy("fecha")->get();
    $inicioMes = $this->getInicioMes($infoCarpeta->annio, $infoCarpeta->mes);

    $totalObraMundial = number_format($recibo->where("tipo", "1")->sum("valor"), 0, ",", ".");
    $totalGastos = $recibo->whereIn("tipo", ["2", "4"])->sum("valor");
    $totalEntradaCongregacion = $recibo->where("tipo", "6")->sum("valor");
    $totalConsignacion = number_format(($recibo->where("tipo", "5")->sum("valor")), 0, ",", ".");
    $balance = number_format($inicioMes + $totalEntradaCongregacion - $totalGastos, 0, ",", ".");
    $totalGastos = number_format($totalGastos, 0, ",", ".");
    $totalEntradaCongregacion = number_format($totalEntradaCongregacion, 0, ",", ".");

    return view('principal')->with("infoCarpeta", $infoCarpeta)
                            ->with("lstRecibos", $recibo)
                            ->with("totalObraMundial", $totalObraMundial)
                            ->with("totalGastos", $totalGastos)
                            ->with("totalEntradaCongregacion", $totalEntradaCongregacion)
                            ->with("totalConsignacion", $totalConsignacion)
                            ->with("inicioMes", $inicioMes)
                            ->with("balance", $balance);
  }

}
function delCarpeta(Request $request){
  $infoCarpeta = Carpeta::find($request->id);
  if(isset($infoCarpeta->id)){
      $lstRecibos = Recibo::where("idCarpeta", $request->id)->get();
      if(count($lstRecibos) > 0){
          echo json_encode(["STATUS" => false, "MENSAJE" => "No es posible eliminar la carpeta porque contiene recibos. Primero elimine todos los recibos y vuelva a intentarlo"]);
      }else{
          $result = $infoCarpeta->delete();
          if($result){
            $congregacion = session('idCongregacion', false);
            echo json_encode(["STATUS" => true, "MENSAJE" => "La carpeta fue eliminada con éxito", "URL" => config("constantes.URL_BASE")."congregacion/".$congregacion]);
          }else{
              echo json_encode(["STATUS" => false, "MENSAJE" => "Ocurrio un problema el intentar eliminar la carpeta. Refresque la pagina y Vuelva a intentarlo"]);
          }
      }
  }else{
    echo json_encode(["STATUS" => false, "MENSAJE" => "La carpeta que intenta eliminar no existe"]);
  }
}

function delRecibo(Request $request){
  $infoRecibo = Recibo::find($request->idRecibo);
  if($infoRecibo != false){
    $idCarpeta = $infoRecibo->idCarpeta;
    $infoRecibo->delete();
    $html = $this->construirTablaRecibos($idCarpeta);
    echo json_encode(["STATUS" => true, "html" => $html]);
  }else{
    echo json_encode(["STATUS" => false]);
  }

}
function construirTablaRecibos($idCarpeta){
  $lstRecibos = Recibo::where("idCarpeta", $idCarpeta)->orderBy("fecha")->get();
  $infoCarpeta = Carpeta::find($idCarpeta);
  $totalEntradaCongregacion = $lstRecibos->where("tipo", "6")->sum("valor");
  $totalGastos = $lstRecibos->whereIn("tipo", ["2", "4"])->sum("valor");

  $inicioMes = $this->getInicioMes($infoCarpeta->annio, $infoCarpeta->mes);
  $return["totalObraMundial"] = number_format($lstRecibos->where("tipo", "1")->sum("valor"), 0, ",", ".");
  $return["totalGastos"] = number_format($totalGastos, 0, ",", ".");
  $return["totalEntradaCongregacion"] = number_format($totalEntradaCongregacion, 0, ",", ".");
  $return["totalConsignacion"] = number_format($lstRecibos->where("tipo", "5")->sum("valor"), 0, ",", ".");
  $return["balance"] = number_format(($inicioMes + $totalEntradaCongregacion - $totalGastos), 0, ",", ".");
  $return["html"] = "";

  $objPermisos = new Permisos_userController();
  $acceso = $objPermisos->permisoParaSeguir("permisosCuentas", "controlTotal");

  foreach($lstRecibos as $recibo){
      $return["html"] .= '
                <tr class="tipoRecibo'.$recibo->tipo.'">
                  <td>'. date("m/j",$recibo->fecha) .'</td>
                  <td class="hidden-xs">'. $this->tiposRecibos[$recibo->tipo] .'</td>
                  <td>'. number_format($recibo->valor, 0, ",", ".") .'</td>
                  <td>'. $recibo->descripcion .'</td>';
                  if($acceso){
                    $return["html"] .='<td class="text-center"><span class="fa fa-trash pointer deleteRecibo" data-identificacion="'. $recibo->id .'"></span></td>';
                  }
                  $return["html"] .='</tr>';
  }
  return $return;
}

function addRecibo(Request $request){
  $recibo = new Recibo;
  $recibo->idCarpeta = $request->idCarpeta;
  $recibo->tipo = $request->tipo;
  $recibo->valor = $request->valor;
  if($request->tipo == 1){
      $recibo->descripcion = "Obra Mundial";
  }elseif($request->tipo == 2){
      $recibo->descripcion = $request->descripcion;
  }elseif($request->tipo == 3){
      $recibo->descripcion = "Entrada - Resolución Salones";
  }elseif($request->tipo == 4){
      $recibo->descripcion = "Mi Circuito";
  }elseif($request->tipo == 5){
      $recibo->descripcion = $request->descripcion;
  }elseif($request->tipo == 6){
      $recibo->descripcion = "Gastos Congregación";
  }
  $recibo->user = Auth::user()->id;
  $recibo->fecha = strtotime($request->fecha);
  $insert = $recibo->save();

  if($insert){
    $html = $this->construirTablaRecibos($request->idCarpeta);
    echo json_encode(["STATUS" => true, "html" => $html]);
  }else{
    echo json_encode(["STATUS" => false]);
  }
}

function set_miles($numero){
  if(isset($numero) && !empty($numero) && is_numeric($numero)){
    return number_format($numero, 0, ",", ".");
  }else{
    return 0;
  }
}
}
