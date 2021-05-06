<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
   protected $guarded = array();

	protected $table = 'videos';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

}
