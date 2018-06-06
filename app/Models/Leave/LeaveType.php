<?php

namespace App\Models\Leave;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
	protected $fillable = ['description', 'code', 'balance'];

	protected $casts = [
		'id'		=>	'integer',
		'balanace'	=>	'integer'
	];

	public function leaveDetail()
	{
		return $this->belongsTo('App\Models\Leave\LeaveType');
	}
}
