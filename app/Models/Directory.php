<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
	protected $fillable = [
		'person_id',
		'address_id',
		'company_id'
	];

	protected $casts = [
		'person_id'		=> 'integer',
		'address_id'	=> 'integer',
		'company_id'	=> 'integer'
	];

	public function directoryDetails()
	{
		return $this->hasMany('App\Models\DirectoryDetail');
	}

	public function person()
	{
		return $this->belongsTo('App\Models\Person');
	}

	public function address()
	{
		return $this->belongsTo('App\Models\Address');
	}

	public function company()
	{
		return $this->belongsTo('App\Models\Company');
	}
}
