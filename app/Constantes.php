<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constantes extends Model
{
  protected $table = 'constantes';

  protected $fillable = [
      'id', 'campo', 'valor'
  ];
}
