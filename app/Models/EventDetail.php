<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
	protected $fillable = [
		'address_book_id',
		'event_id'
	];

	protected $casts = [
		'address_book_id'	=>	'integer',
		'event_id'			=>	'integer',
		'id'				=>	'integer'
	];

	public function addressBooks()
	{
		return $this->belongsTo('App\Models\AddressBook');
	}

	public function event()
	{
		return $this->belongsTo('App\Models\Event');
	}
}
