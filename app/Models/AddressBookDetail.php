<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressBookDetail extends Model
{
	protected $fillable = [
		'address_book_id',
		'address_book_participant_id'
	];

	protected $casts = [
		'address_book_id'				=>	'integer',
		'address_book_participant_id'	=>	'integer',
		'id'							=>	'integer'
	];

	public function addressBook()
	{
		return $this->belongsTo('App\Models\AddressBook');
	}

	public function addressBookParticipant()
	{
		return $this->belongsTo('App\Models\AddressBookParticipant');
	}
}
