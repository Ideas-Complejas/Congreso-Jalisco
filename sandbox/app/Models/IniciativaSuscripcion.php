<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IniciativaSuscripcion extends Model
{
   protected $guarded = array();

	protected $table = 'iniciativa_suscripciones';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
