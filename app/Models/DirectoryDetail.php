<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryDetail extends Model
{
	protected $fillable = ['directory_id', 'directory_number_id'];

	protected $casts = [
		'directory_number_id'	=>	'integer',
		'directory_id'			=>	'integer',
		'id'					=>	'integer'
	];

	public function directory()
	{
		return $this->belongsTo('App\Models\Directory');
	}

	public function directoryNumbers()
	{
		return $this->belongsTo('App\Models\DirectoryNumber', 'directory_number_id');
	}
}
