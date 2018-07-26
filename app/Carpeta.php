<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
  protected $table = "carpeta";

  protected $fillable = [
      'id', 'idCongregacion', 'annio', 'mes', 'vlrInicioMes', 'balance', 'obraMundial', 'totalGastos', 'resolucionSalones', 'cajaCongregacion'
  ];
}
