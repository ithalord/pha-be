<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
	public function addressBookDetails()
	{
		return $this->hasMany('App\Models\AddressBookDetail');
	}
}
