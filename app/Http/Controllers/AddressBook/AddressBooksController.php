<?php

namespace App\Http\Controllers\AddressBook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddressBook;

class AddressBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function searchMembers(Request $request)
    {
        $query = $request['keyword'];

        $members = AddressBook::where('is_attended', false)
            ->search($query)
            ->simplePaginate(20);

        return response()->json($members);
    }

    public function searchAllMembers(Request $request)
    {
        $query = $request['keyword'];

        $members = AddressBook::search($query)
            ->simplePaginate(20);

        return response()->json($members);
    }

    public function changeIsAttended($id)
    {
        $addressBook = AddressBook::find($id);

        $addressBook->is_attended  = !$addressBook['is_attended'];
        $addressBook->save();

        return response()->json($addressBook);
    }

    public function registerRFID(Request $request)
    {
        $id = $request['id'];
        $serial = $request['serial'];

        $addressBook = AddressBook::find($id);

        $addressBook->card_id = $serial;
        $addressBook->save();

        return response()->json($addressBook);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
