<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos_user extends Model
{
  protected $table = "permisos_user";

  protected $fillable = [
      'id', 'id_user', 'config'
  ];

  public function permisos()
   {
       return $this->hasOne('App\Permisos_user;', 'id_user');
   }
}
