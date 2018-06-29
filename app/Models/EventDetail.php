<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
	protected $fillable = [
		'address_book_id',
		'event_id',
		'is_deleted',
		'is_attended'
	];

	protected $casts = [
		'address_book_id'	=>	'integer',
		'event_id'			=>	'integer',
		'id'				=>	'integer',
		'is_deleted'		=>	'boolean',
		'is_attended'		=>	'boolean'
	];

	public function addressBook()
	{
		return $this->belongsTo('App\Models\AddressBook', 'address_book_id');
	}

	public function event()
	{
		return $this->belongsTo('App\Models\Event');
	}
}
