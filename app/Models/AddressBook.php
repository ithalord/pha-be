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
           'hospital_name'     => 10,
           'pha_code'          => 10,
           'medical_director'  => 5,
           'chief_of_hospital' => 5,
           'region'            => 5
       ]
   ];

   protected $casts = [
    'id'  =>  'integer'
   ];

	public function addressBookDetails()
	{
		return $this->hasMany('App\Models\AddressBookDetail');
	}
}
