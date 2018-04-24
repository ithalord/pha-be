<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressBookParticipant extends Model
{
	protected $fillable = [
		'designation',
		'firstname',
		'middlename',
		'lastname',
		'suffixname',
		'is_attending'
	];

	protected $casts = [
		'id'			=>	'integer',
		'is_attending'	=>	'boolean'
	];

	public function addressBookDetail()
	{
		return $this->belongsTo('App\Models\AddressBookDetail');
	}
}
