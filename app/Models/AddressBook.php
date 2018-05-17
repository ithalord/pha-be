<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class AddressBook extends Model
{
    use SearchableTrait;

    /**
    * Searchable rules.
    *
    * @var array
    */
   protected $searchable = [
       /**
        * Columns and their priority in search results.
        * Columns with higher values are more important.
        * Columns with equal values have equal importance.
        *
        * @var array
        */
       'columns' => [
           'addressbooks.hospital_name'    => 10,
           // 'medical_director'   => 10,
           // 'administrative_officer'  => 10,
           // 'region' => 30,
           'addressbooks.pha_code'   => 5
       ]
   ];

   protected $table = 'address_books';

	public function addressBookDetails()
	{
		return $this->hasMany('App\Models\AddressBookDetail');
	}
}
