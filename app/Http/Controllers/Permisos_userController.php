<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permisos_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class Permisos_userController extends Controller
{
    function validarPermiso($asdf){

    }

    function permisoParaSeguir($key, $permiso){
      $permisosUser = Permisos_user::where("id_user", Auth::user()->id)->get();
      if(count($permisosUser) > 0){
        $config = json_decode($permisosUser[0]->config);
        if($config->{$key} === $permiso){
          return true;
        }else{
          return false;
        }

      }else{
        return false;
      }
    }
}
