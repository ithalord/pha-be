<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DitectoryNumberType extends Model
{
	protected $fillable = ['description'];

	protected $casts = ['id' => 'integer'];

	public function directoryNumber()
	{
		return $this->belongsTo('App\Models\DirectoryNumber');
	}
}
