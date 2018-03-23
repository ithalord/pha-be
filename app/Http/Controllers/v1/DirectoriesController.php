<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\Models\DirectoryDetail;
use App\Models\DirectoryNumber;
use App\Models\Person;
use App\Models\Address;
use App\Models\Company;

class DirectoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directories = Directory::with(
            'person',
            'address',
            'company',
            'directoryDetails.directoryNumber.ditectoryNumberType'
        )->get();

        return response()->json(['directories' => $directories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = $request->input('person');
        $address = $request->input('address');
        $company = $request->input('company');
        $contacts = $request->input('contacts');

        $person = Person::create([
            'firstname' =>  $person['firstname'],
            'middlename' =>  $person['middlename'],
            'lastname' =>  $person['lastname'],
            'suffixname' =>  $person['suffixname'],
            'designation' =>  $person['designation'],
            'fullname' =>  $person['fullname']
        ]);

        $address = Address::create([
            'street' =>  $address['street'],
            'barangay_id' =>  $address['barangay_id'],
            'city_id' =>  $address['city_id'],
            'province_id' =>  $address['province_id'],
            'region_id' =>  $address['region_id'],
            'complete_address' =>  $address['complete_address']
        ]);

        $company = Company::create([
            'description'   =>  $company['description'],
            'abbreviation'   =>  $company['abbreviation']
        ]);

        $directory = Directory::create([
            'person_id' =>  $person['id'],
            'address_id' =>  $address['id'],
            'company_id' =>  $company['id']
        ]);

        foreach($contacts as $con) {
            $contact = DirectoryNumber::create($con);
            $contact->save();
            $directoryDetail = DirectoryDetail::create([
                'directory_id'          =>  $directory['id'],
                'directory_number_id'   =>  $contact['id']
            ]);
        }

        $directory = Directory::with(
            'person',
            'address',
            'company',
            'directoryDetails.directoryNumber.ditectoryNumberType'
        )->find($directory->id);

        return response()->json(['directory' => $directory]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $directory = Directory::with(
            'person',
            'address',
            'company',
            'directoryDetails.directoryNumber.ditectoryNumberType'
        )->find($id);

        return response()->json(['directory' => $directory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
