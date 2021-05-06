<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IniciativaComentario extends Model
{
   protected $guarded = array();

	protected $table = 'iniciativa_comentarios';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
