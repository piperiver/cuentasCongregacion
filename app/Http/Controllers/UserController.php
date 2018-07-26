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

class UserController extends Controller
{
  
  function usuarios(){
      $users = DB::table('users')->leftJoin('permisos_user', 'users.id', '=', 'permisos_user.id_user')->select("users.*", "permisos_user.config as config")->get();
      return view('usuarios')->with("users", $users);
  }
  function construirTablaUsuarios(){
    $users = DB::table('users')->leftJoin('permisos_user', 'users.id', '=', 'permisos_user.id_user')->select("users.*", "permisos_user.config as config")->get();
    $html = "";
    foreach($users as $user){
      $html.= '<tr>
                <td>'.$user->name.'</td>
                <td class="hidden-xs">'.$user->email.'</td>
                <td></td>
                <td class="text-center">
                  <a style="cursor: pointer;" class="deleteUser" data-id="'.$user->id.'">
                    <span class="fa fa-trash" style="color: #d9534f; font-size: 1.5em;"></span>
                  </a>
                  <a style="cursor: pointer;" data-infoUser=\''. json_encode($user) .'\' class="editUser">
                    <span class="fa fa-pencil" style="color: #286192;font-size: 1.5em; margin: 0 5px"></span>
                  </a>
                  <a id="iconPermiso'.$user->id.'" style="cursor: pointer;" data-infoUser=\''.json_encode($user).'\' class="permisosUser">
                    <span class="fa fa-lock" style="color: #619228; font-size: 1.5em"></span>
                  </a>
                </td>
              </tr>';
    }
    return $html;
  }

  function addUser(Request $request){
      $user = new User;
      $user->name = $request->nombre;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $result = $user->save();
      if($result){
        echo json_encode(["STATUS" => true, "htmlTabla" => $this->construirTablaUsuarios()]);
      }else{
        echo json_encode(["STATUS" => false]);
      }

  }
  function updateUser(Request $request){
    $user = User::find($request->id);
    if(isset($user->id)){
      $user->name = $request->nombre;
      $user->email = $request->email;
      if($request->password != false){
        $user->password = Hash::make($request->password);
      }
      $result = $user->save();
      if($result){
        echo json_encode(["STATUS" => true, "htmlTabla" => $this->construirTablaUsuarios()]);
      }else{
        echo json_encode(["STATUS" => false]);
      }
    }
  }

  function permisos(Request $request){
    $infoUser = json_decode($request->infoUser);
    $permisos = Permisos_user::where("id_user", $infoUser->id)->get();
    if(count($permisos) > 0){
      $result = Permisos_user::where("id_user", $infoUser->id)->update(["config" => json_encode(["permisosCuentas" => $request->permisoSel])]);
    }else{
      $permisos = new Permisos_user;
      $permisos->id_user = $infoUser->id;
      $permisos->config = json_encode(["permisosCuentas" => $request->permisoSel]);
      $result = $permisos->save();
    }

    if($result){
      echo json_encode(["STATUS" => true, "MENSAJE" => "Permisos guardados satisfactoriamente"]);
    }else{
      echo json_encode(["STATUS" => false, "MENSAJE" => "Ocurrio un problema al tratar de guardar los permisos. Por favor recargue la pagina e intentelo de nuevo"]);
    }
  }

  function delUser(Request $request){
    $user = User::find($request->id);
    $result = $user->delete();
    if($result){
      echo json_encode(["STATUS" => true, "htmlTabla" => $this->construirTablaUsuarios()]);
    }else{
      echo json_encode(["STATUS" => false]);
    }
  }
}
