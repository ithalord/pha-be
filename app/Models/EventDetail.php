<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class EventDetail extends Model
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
           'address_books.hospital_name'	=> 10,
           'address_books.region'			=> 5
       ],
       'joins' => [
       		'address_books' => ['address_books.id', 'event_details.address_book_id']
       ]
   ];
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
