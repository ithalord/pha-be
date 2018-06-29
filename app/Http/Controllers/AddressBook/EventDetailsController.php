<?php

namespace App\Http\Controllers\AddressBook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\AddressBook;

class EventDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(EventDetail::all());
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

    public function changeIsAttended($id)
    {
        $eventDetail = EventDetail::find($id);

        $eventDetail->is_attended = !$eventDetail['is_attended'];
        $eventDetail->save();

        $event = Event::with('eventDetails.addressBook.addressBookDetailsAttendingOnly.attendee')
                ->where('on_going', true)
                ->find($eventDetail['event_id']);

        return response()->json(['event' => $event]);
    }

    public function addHospital(Request $request)
    {
        $input = $request->all();

        $eventDetail = EventDetail::create([
            'address_book_id'   =>  $input['address_book_id'],
            'event_id'          =>  $input['event_id'],
            'is_attended'       =>  0
        ]);

        $eventDetail = EventDetail::with('addressBook')->find($eventDetail['id']);

        $addressBook = AddressBook::find($input['address_book_id']);

        $addressBook->is_attended = 1;
        $addressBook->save();

        return response()->json($eventDetail);
    }

    public function softDelete(Request $request)
    {
        $input = $request->all();

        $event_detail_id = $input['event_detail_id'];
        $address_book_id = $input['address_book_id'];

        $eventDetail = EventDetail::find($event_detail_id);

        $eventDetail->is_deleted = true;
        $eventDetail->save();

        $addressBook = AddressBook::find($address_book_id);

        $addressBook->is_attended = !$addressBook->is_attended;
        $addressBook->save();

        return response()->json(['status' => 'successfully deleted']);
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
