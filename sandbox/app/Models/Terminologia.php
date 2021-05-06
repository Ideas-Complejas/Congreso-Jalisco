<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terminologia extends Model
{
   protected $guarded = array();

	protected $table = 'terminologias';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

}
