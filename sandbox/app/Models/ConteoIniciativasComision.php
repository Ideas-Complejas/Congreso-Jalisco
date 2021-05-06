<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConteoIniciativasComision extends Model
{
   protected $guarded = array();

	protected $table = 'conteo_iniciativas_comision';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
