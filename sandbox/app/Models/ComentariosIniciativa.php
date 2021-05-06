<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComentariosIniciativa extends Model
{
   protected $guarded = array();

	protected $table = 'comentarios_iniciativa';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
