<?php

namespace App\Models\Leave;

use Illuminate\Database\Eloquent\Model;

class LeaveDetail extends Model
{
	protected $fillable = ['from', 'to', 'status', 'duration', 'leave_type_id'];

	protected $casts = [
		'id'			=>	'integer',
		'leave_type_id'	=>	'integer',
		'duration'		=>	'integer'
	];

	public function leave()
	{
		return $this->belongsTo('App\Models\Leave\Leave');
	}

	public function leaveType()
	{
		return $this->belongsTo('App\Models\Leave\LeaveType');
	}
}
