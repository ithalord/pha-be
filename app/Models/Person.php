<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	protected $fillable = [
		'firstname',
		'middlename',
		'lastname',
		'suffixname',
		'designation',
		'fullname'
	];

	protected $casts = [
		'id'	=>	'integer'
	];

	public function directory()
	{
		return $this->belongsTo('App\Models\Directory');
	}
}
