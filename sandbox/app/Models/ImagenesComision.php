<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenesComision extends Model
{
   protected $guarded = array();

	protected $table = 'imagenes_comisiones';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
