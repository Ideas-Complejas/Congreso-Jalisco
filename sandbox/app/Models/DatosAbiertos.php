<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosAbiertos extends Model
{
   protected $guarded = array();

	protected $table = 'datos_abiertos';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
