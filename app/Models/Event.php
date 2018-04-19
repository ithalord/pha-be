<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = ['name', 'description', 'from', 'to', 'start_time', 'end_time', 'year_id', 'on_going', 'loyalty_points'];

	protected $casts = [
		'id'				=>	'integer',
		'year_id'			=>	'integer',
		'on_going'			=>	'boolean',
		'loyalty_points'	=>	'integer'
	];

	public function year()
	{
		return $this->belongsTo('App\Models\Year');
	}
}
