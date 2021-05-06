<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComisionesEstudianIniciativa extends Model
{
   protected $guarded = array();

	protected $table = 'comisiones_estudian_iniciativa';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
