<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Congregacion extends Model
{
  protected $table = 'congregacion';

  protected $fillable = [
      'id', 'nombre', 'codigo'
  ];
}
