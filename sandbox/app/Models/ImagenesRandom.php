<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenesRandom extends Model
{
   protected $guarded = array();

	protected $table = 'imagenes_random';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
