<?php

namespace App\Models\Leave;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = ['firstname', 'middlename', 'lastname', 'suffix'];

	protected $casts = [
		'id'		=>		'integer'
	];

	public function leave()
	{
		return $this->hasMany('App\Models\Leave\Leave');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
