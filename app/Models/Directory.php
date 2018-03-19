<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
	protected $fillable = [
		'directory_number_id',
		'address',
		'person'
	];

	protected $casts = [
		'directory_number_id'	=> 'integer',
		'id'					=> 'integer'
	];

	public function directoryDetails()
	{
		return $this->hasMany('App\Models\DirectoryDetail');
	}
}
