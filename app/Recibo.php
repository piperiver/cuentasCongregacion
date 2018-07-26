<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
  protected $table = "recibo";

  protected $fillable = [
      'id', 'idCarpeta', 'tipo', 'valor', 'descripcion', 'fecha'
  ];
}
