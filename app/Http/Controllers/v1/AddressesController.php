<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;

class AddressesController extends Controller
{
	public function index()
	{
		return response()->json(['addresses' => Address::all()]);
	}
}
