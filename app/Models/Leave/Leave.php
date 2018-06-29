<?php

namespace App\Models\Leave;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
	protected $fillable = ['employee_id', 'leave_detail_id'];

	protected $casts = [
		'leave_detail_id'	=>		'integer',
		'employee_id'		=>		'integer',
		'id'				=>		'integer'
	];

	public function leaveDetails()
	{
		return $this->belongsTo('App\Models\Leave\LeaveDetail', 'leave_detail_id');
	}

	public function employee()
	{
		return $this->belongsTo('App\Models\Leave\Employee');
	}
}
