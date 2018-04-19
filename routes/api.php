<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('log')->group(function() {
	 Route::resource('/types', 'v1\DirectoryNumberTypesController',
        array('except' => array('create', 'edit')));

	 Route::resource('/contacts', 'v1\DirectoryNumbersController',
        array('except' => array('create', 'edit')));

	 Route::resource('/directories', 'v1\DirectoriesController',
        array('except' => array('create', 'edit')));

	 Route::resource('/companies', 'v1\CompaniesController',
        array('except' => array('create', 'edit')));

	 Route::resource('/addresses', 'v1\AddressesController',
        array('except' => array('create', 'edit')));

	 Route::prefix('get')->group(function() {
	 	Route::get('find_by_description', 'v1\CompaniesController@searchByDescription');
	 });
});

Route::prefix('address_book')->group(function() {
	 Route::resource('/years', 'AddressBook\YearsController',
        array('except' => array('create', 'edit')));

	 Route::resource('/events', 'AddressBook\EventsController',
        array('except' => array('create', 'edit')));
});

Route::prefix('auth')->group(function() {
	Route::post('/login', 'v1\AuthenticationController@authenticate');
});
