<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $fillable = [
		'street',
		'barangay_id',
		'city_id',
		'province_id',
		'region_id',
		'complete_address'
	];

	protected $casts = [
		'barangay_id'	=>	'integer',
		'city_id'		=>	'integer',
		'province_id'	=>	'integer',
		'region_id'		=>	'integer'
	];

	public function directory()
	{
		return $this->belongsTo('App\Models\Directory');
	}
}
