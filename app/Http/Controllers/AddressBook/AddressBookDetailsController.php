<?php

namespace App\Http\Controllers\AddressBook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddressBook;
use App\Models\AddressBookDetail;
use App\Models\AddressBookParticipant;

class AddressBookDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['address_books' => AddressBook::all()]);
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
        $input = $request->all();
        $participants = $input['participants'];

        foreach($participants as $p) {
            $addressBookParticipant = AddressBookParticipant::create([
                'designation'       =>  $p['designation'],
                'firstname'       =>  $p['firstname'],
                'middlename'       =>  $p['middlename'],
                'lastname'       =>  $p['lastname'],
                'suffixname'       =>  $p['suffixname'],
                'is_attending'       =>  $p['is_attending']
            ]);

            $addressBookDetail = AddressBookDetail::create([
                'address_book_participant_id' => $addressBookParticipant['id'],
                'address_book_id' => $input['address_book_id']
            ]);
        }

        $addressBook = AddressBook::with('addressBookDetails.addressBookParticipant')->find($input['address_book_id']);

        return response()->json(['address_book' => $addressBook]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addressBook = AddressBook::with('addressBookDetails.addressBookParticipant')->find($id);

        return response()->json(['address_book' => $addressBook]);
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
