<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = ['description', 'abbreviation'];

	protected $casts = ['id'	=>	'integer'];

	public function directory()
	{
		return $this->belongsTo('App\Models\Directory');
	}
}
