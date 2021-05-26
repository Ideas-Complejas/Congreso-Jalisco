<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenesRandomDato extends Model
{
   protected $guarded = array();

	protected $table = 'imagenes_random_datos';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
