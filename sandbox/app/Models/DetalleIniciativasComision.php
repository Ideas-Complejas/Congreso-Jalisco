<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleIniciativasComision extends Model
{
   protected $guarded = array();

	protected $table = 'detalle_iniciativas_comision';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
