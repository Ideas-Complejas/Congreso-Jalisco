<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diputado extends Model
{
   protected $guarded = array();

	protected $table = 'diputados';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = false;

}
