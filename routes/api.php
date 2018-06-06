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

	 	Route::get('/address_books', 'AddressBook\AddressBooksController@searchMembers');
	 	Route::get('/all', 'AddressBook\AddressBooksController@searchAllMembers');
	 });
});

Route::prefix('change')->group(function() {
	Route::get('/event/{id}', 'AddressBook\EventsController@changeCurrent');
	Route::get('/year/{id}', 'AddressBook\YearsController@changeCurrent');
	Route::get('event_detail/{id}', 'AddressBook\AddressBooksController@changeIsAttended');
	Route::get('register_rfid', 'AddressBook\AddressBooksController@registerRFID');
	Route::get('is_attending/{id}', 'AddressBook\AddressBookParticipantsController@changeIsAttending');
});

Route::prefix('delete')->group(function() {
	Route::get('/event_detail', 'AddressBook\EventDetailsController@softDelete');
});

Route::prefix('current')->group(function() {
	Route::get('/years', 'AddressBook\YearsController@getCurrent');
	Route::get('/year_only', 'AddressBook\YearsController@yearOnly');
	Route::get('/event/{id}', 'AddressBook\EventsController@currentEvent');
});

Route::prefix('address_book')->group(function() {
	 Route::resource('/years', 'AddressBook\YearsController',
        array('except' => array('create', 'edit')));

	 Route::resource('/events', 'AddressBook\EventsController',
        array('except' => array('create', 'edit')));

	 Route::resource('/participants', 'AddressBook\AddressBookDetailsController',
        array('except' => array('create', 'edit')));

	 Route::resource('/person', 'AddressBook\AddressBookParticipantsController',
        array('except' => array('create', 'edit')));

	 Route::prefix('add')->group(function() {
	 	Route::post('event_details', 'AddressBook\EventDetailsController@addHospital');
	 });
});

Route::prefix('leave')->group(function() {
	 Route::resource('/leave_types', 'Leave\LeaveTypesController',
        array('except' => array('create', 'edit')));

	 Route::resource('/employees', 'Leave\EmployeesController',
        array('except' => array('create', 'edit')));

	 Route::resource('/leave_details', 'Leave\LeaveDetailsController',
        array('except' => array('create', 'edit')));
});

Route::prefix('auth')->group(function() {
	Route::post('/login', 'v1\AuthenticationController@authenticate');
});
