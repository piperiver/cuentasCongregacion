@inject('objCongregacionController', 'App\Http\Controllers\CongregacionController')
@inject('objPermisos', 'App\Http\Controllers\Permisos_userController')
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('imagenes/favicon.ico') }}" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('constantes.proyecto') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('template/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('template/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('template/vendor/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('template/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom DATATABLES -->
    <link href="{{ asset('template/vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/alertify.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/themes/default.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Estilos Personalizados Globales -->
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js') }} IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js') }} doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js') }}/1.4.2/respond.min.js') }}"></script>
    <![endif]-->

</head>

<body>
<!-- Inicio Modales -->
@if($objPermisos->permisoParaSeguir("permisosCuentas", "controlTotal"))
  <div class="modal fade" id="AgregarCarpeta" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Parámetro</h4>
                </div>
                <div class="modal-body">

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Crear Nueva Carpeta</h3>
                    </div>
                    <div class="panel-body">

                      <div class="form-group">
                        <label for="annioCarpeta">Digite el Año</label>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                          <input type="number" class="form-control" id="annioCarpeta" placeholder="Digite aquí el año">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Digite el año al que pertenece esta carpeta."><span class="fa fa-question-circle"></span></div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="mesCarpeta">Seleccione el Mes</label>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                          <select class="form-control" id="mesCarpeta">
                            <option value="0">Seleccione un Mes</option>
                            <option value="1">ENERO</option>
                            <option value="2">FEBRERO</option>
                            <option value="3">MARZO</option>
                            <option value="4">ABRIL</option>
                            <option value="5">MAYO</option>
                            <option value="6">JUNIO</option>
                            <option value="7">JULIO</option>
                            <option value="8">AGOSTO</option>
                            <option value="9">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                          </select>
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Seleccione el mes al que desea crearle la carpeta."><span class="fa fa-question-circle"></span></div>
                        </div>
                      </div>
                      <div class="well hide">
                        <button class="btn btn-primary center-block" id="calculoFondosInicioMes">Calcular Fondos</button>
                      <div class="form-group">
                        <label for="annioCarpeta">Fondos inicio de Mes</label>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="fa fa-dollar"></span></div>
                          <input type="text" class="form-control" readonly="true" disabled="true" id="inicioMes" value="">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Es el dinero con el que la congregacion cuenta al iniciar el mes."><span class="fa fa-question-circle"></span></div>
                        </div>
                        <div id="notificationCalculo" class="alert alert-warning alert-dismissable margin-top-10" style="display: none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          No se encontraron Fondos de inicio mes. Por favor digitelo manualmente
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btGuardar" name="btGuardar" class="btn btn-guardar">Guardar</button>
                    <button type="button" class="btn btn-cerrar" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Fin Modales -->
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
              <!-- /.navbar-top-links -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ config("constantes.URL_BASE") }}congregacion/{{ $objCongregacionController->getIdCongregacion() }}">{{ Auth::user()->name }}</a>
            </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <p class="nombreCongregacion">{{ $objCongregacionController->getNameCongregacion() }}</p>
                    <p class="titleCarpetasMenu titleListCarpetas">Carpetas</p>
                    <ul class="nav" id="side-menu">
                           <?php echo $objCongregacionController->buildMenu() ?>
                    </ul>
                    @if($objPermisos->permisoParaSeguir("permisosCuentas", "controlTotal"))
                      <div id="containerAgregarCarpeta" style="margin-top: 10px">
                          <a class="pointer btnAgregarCarpetas" data-toggle="modal" data-target="#AgregarCarpeta"><i class="fa fa-plus fa-fw"></i> Agregar Carpeta</a>
                      </div>
                    @endif
                    <a class="btnAgregarCarpetas" style="margin-top: 10px;margin-bottom: 10px;background: #555555;" href="{{ config("constantes.URL_BASE") }}home">
                      <i class="fa fa-home"></i> Modulos
                    </a>

                    <a class="btnAgregarCarpetas" style="margin-top: 10px;margin-bottom: 10px;background: #ea5850;" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out fa-fw"></i> Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>

                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
          @yield("content")
        </div>
      <!-- /#page-wrapper -->
      <input id="idCongregacion" value="{{ $objCongregacionController->getIdCongregacion() }}" type="hidden">
      <input id="url_base" value="{{ config("constantes.URL_BASE") }}" type="hidden">
      <input type="hidden"  name="_token" id="_token" value="{{ csrf_token() }}">
  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="{{ asset('template/vendor/metisMenu/metisMenu.min.js') }}"></script>

  <!-- Morris Charts JavaScript -->
  <script src="{{ asset('template/vendor/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('template/vendor/morrisjs/morris.min.js') }}"></script>
  <script src="{{ asset('template/data/morris-data.js') }}"></script>

  <!-- Custom Theme JavaScript -->
  <script src="{{ asset('template/dist/js/sb-admin-2.js') }}"></script>


  <!-- Custom Theme JavaScript DATATABLES -->
  <script src="{{ asset('template/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('template/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('template/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>


  <script src="{{ asset('js/alertify.min.js') }}"></script>
  <!-- Se importa el js global -->
  <script src="{{ asset('js/global.js') }}"></script>
  <script>
           var mediaquery = window.matchMedia("(max-width: 768px)");
           if (mediaquery.matches) {
             $('div.navbar-collapse').addClass('collapse');
             topOffset = 100; // 2-row-menu
           }
   </script>
</body>

</html>
