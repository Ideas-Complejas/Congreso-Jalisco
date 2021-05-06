<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComisionSuscripcion extends Model
{
   protected $guarded = array();

	protected $table = 'comision_suscripciones';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
