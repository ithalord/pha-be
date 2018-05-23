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

	protected $appends = [
		'fullname'
	];

	public function getFullnameAttribute()
	{
        $mi = explode(' ', $this->middlename);
        $initial = '';
        if (count($mi) > 1) {
            foreach ($mi as $m) {
                $initial .= substr($m, 0, 1);
            }
        } else {
            $initial .= substr($this->middlename, 0, 1);
        }

        $suffix = $this->suffixname ? $this->suffixname : '';

        return $this->firstname . ' ' . $initial . '. ' . $this->lastname . ' ' . $suffix;
	}

	public function addressBookDetail()
	{
		return $this->belongsTo('App\Models\AddressBookDetail');
	}
}
