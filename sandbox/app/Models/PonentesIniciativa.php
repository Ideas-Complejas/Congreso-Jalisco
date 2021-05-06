<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PonentesIniciativa extends Model
{
   protected $guarded = array();

	protected $table = 'ponentes_iniciativa';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
