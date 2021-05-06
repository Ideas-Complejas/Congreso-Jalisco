<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadosProcesalesIniciativa extends Model
{
   protected $guarded = array();

	protected $table = 'estados_procesales_iniciativa';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
