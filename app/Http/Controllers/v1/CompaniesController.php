<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompaniesController extends Controller
{
	public function index()
	{
		return response()->json(['companies' => Company::all()]);
	}

	public function searchByDescription(Request $request)
	{
		$description = $request['description'];

		$company = Company::where('description', $description)->first();

		return response()->json(['company' => $company]);
	}
}
