<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryNumber extends Model
{
	protected $fillable = ['contact', 'ditectory_number_type_id'];

	protected $casts = [
		'ditectory_number_type_id'	=> 'integer',
		'id'						=> 'integer'
	];

	public function ditectoryNumberType()
	{
		return $this->belongsTo('App\Models\DitectoryNumberType');
	}

	public function directoryDetail()
	{
		return $this->belongsTo('App\Models\DirectoryDetail');
	}
}
