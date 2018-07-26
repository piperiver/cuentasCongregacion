@inject('objUserController', 'App\Http\Controllers\UserController')
@extends('layouts.app')
@section('content')
<div class="modal fade" id="ModalUsuarios" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <form id="formularioUsuario" action="{{ config("constantes.URL_BASE") }}" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="annioCarpeta">Nombre Completo</label>
                  <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-user"></span></div>
                    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Digite aquí el nombre completo" required>
                    <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Digite el nombre completo del usuario."><span class="fa fa-question-circle"></span></div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="annioCarpeta">Correo electrónico</label>
                  <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-envelope"></span></div>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite aquí el correo electrónico" required>
                    <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="El correo electrónico sera indispensable si se te olvida la contraseña."><span class="fa fa-question-circle"></span></div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="annioCarpeta">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-lock"></span></div>
                    <input type="password" class="form-control" id="contrasenna" name="contrasenna" placeholder="Digite aquí la contraseña" required>
                    <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Digite la contraseña."><span class="fa fa-question-circle"></span></div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="annioCarpeta">Repetir Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-lock"></span></div>
                    <input type="password" class="form-control" id="contrasenna_clon" name="contrasenna_clon" placeholder="Repíta la contraseña" required>
                    <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Repíta la contraseña."><span class="fa fa-question-circle"></span></div>
                  </div>
                </div>

              <div class="alert alert-danger" role="alert" id="error-pass" style="display: none">
                <span class="fa fa-close" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                Las contraseñas no son las mismas. Asegurece de escribir la misma contraseña
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalUpdateUsuarios" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id=""></h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="annioCarpeta">Nombre Completo</label>
            <div class="input-group">
              <div class="input-group-addon"><span class="fa fa-user"></span></div>
              <input type="text" class="form-control" value="" id="nombreUsuario" name="nombreUsuario" placeholder="Digite aquí el nombre completo" required>
              <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Digite el nombre completo del usuario."><span class="fa fa-question-circle"></span></div>
            </div>
          </div>

          <div class="form-group">
            <label for="annioCarpeta">Correo electrónico</label>
            <div class="input-group">
              <div class="input-group-addon"><span class="fa fa-envelope"></span></div>
              <input type="email" class="form-control" value="" id="email" name="email" placeholder="Digite aquí el correo electrónico" required>
              <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="El correo electrónico sera indispensable si se te olvida la contraseña."><span class="fa fa-question-circle"></span></div>
            </div>
          </div>

          <a style="cursor: pointer" class="dspContainerPassword">Cambiar Contraseña</a>

          <div class="containerPassword" style="display: none">
            <div class="form-group">
              <label for="annioCarpeta">Contraseña</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="fa fa-lock"></span></div>
                <input type="password" class="form-control" id="contrasenna" name="contrasenna" placeholder="Digite aquí la contraseña" required>
                <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Digite la contraseña."><span class="fa fa-question-circle"></span></div>
              </div>
            </div>

            <div class="form-group">
              <label for="annioCarpeta">Repetir Contraseña</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="fa fa-lock"></span></div>
                <input type="password" class="form-control" id="contrasenna_clon" name="contrasenna_clon" placeholder="Repíta la contraseña" required>
                <div class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Repíta la contraseña."><span class="fa fa-question-circle"></span></div>
              </div>
            </div>

            <div class="alert alert-danger" role="alert" id="error-pass" style="display: none">
              <span class="fa fa-close" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              Las contraseñas no son las mismas. Asegurece de escribir la misma contraseña
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary updateUsuario" data-url="{{ config("constantes.URL_BASE") }}">Actualizar</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Permisos  -->
<div class="modal fade" id="ModalPermisosUsuario" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">PERMISOS</h4>
      </div>
      <div class="modal-body">
        <form id="formularioPermisos">
          <fieldset class="text-center">
            <legend>CUENTAS</legend>
            <div class="row">
              <div class="col-md-6">
                <div class="container-check soloLectura"><span class="fa fa-circle-o"></span><input class="hide" type="radio" name="perfilCuentas" value="soloLectura"> Solo Lectura</div>
              </div>
              <div class="col-md-6">
                <div class="container-check controlTotal"><span class="fa fa-circle-o"></span><input class="hide" type="radio" name="perfilCuentas" value="controlTotal"> Control Total</div>
              </div>
            </div>
          </fieldset>
          <input name="infoUsuario" id="infoUsuario" type="hidden">
        </form>
      </div>
      <div class="modal-footer">
        <span class="pull-left" id="nombreUsuario"></span>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          Usuarios
          <a style="cursor: pointer" id="addUsuario" class="pull-right" data-toggle="modal" data-target="#ModalUsuarios"><span class="fa fa-plus"></span></a>
        </h3>
      </div>
      <div class="panel-body">

        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th class="hidden-xs">email</th>
              <th>Rol</th>
              <th class="text-center">Opciones</th>
            </tr>
          </thead>
          <tbody id="bodyTablaUsers">
            <?php echo $objUserController->construirTablaUsuarios() ?>
          </tbody>
        </table>

      </div>
    </div>
    <input type="hidden"  name="_token" id="_token" value="{{ csrf_token() }}">
    <input type="hidden"  name="url_base" id="url_base" value="{{ config("constantes.URL_BASE") }}">
  </div>
</div>
@endsection
