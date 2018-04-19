<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
	protected $fillable = ['from', 'to', 'description', 'current'];

	protected $casts = [
		'id'		=>	'integer',
		'current'	=>	'boolean'
	];

	public function events()
	{
		return $this->hasMany('App\Models\Event');
	}
}
