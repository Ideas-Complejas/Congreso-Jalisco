<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iniciativa extends Model
{
   protected $guarded = array();

	protected $table = 'iniciativas';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

}
