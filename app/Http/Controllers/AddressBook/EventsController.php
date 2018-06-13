<?php

namespace App\Http\Controllers\AddressBook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Year;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['events' => Event::all()]);
    }

    public function changeCurrent($id)
    {
        $previous = Event::where('on_going', true)->first();
        if ($previous) {
            $previous->on_going = false;
            $previous->save();
        }

        $setting = Event::find($id);
        $setting->on_going = true;
        $setting->save();

        return response()->json(Event::all());
    }

    public function currentEvent($id)
    {
        $eventOnly = Event::where('on_going', true)
            ->where('year_id', $id)
            ->first();

            $event = Event::with('eventDetails.addressBook.addressBookDetailsAttendingOnly.attendee')
                ->where('on_going', true)
                ->where('year_id', $id)
                ->first();

        return response()->json(['current_event' => $event, 'event_only' => $eventOnly]);
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

    	$this->validate($request, array(
    		'name'	=>		'required',
    		'description'	=>		'required',
    		'from'	=>		'required',
    		'to'	=>		'required',
    		'start_time'	=>		'required',
    		'end_time'	=>		'required',
    		'year_id'	=>		'required',
    	));

    	$event = Event::create($input);
    	$event->save();
    	$event = Event::find($event->id);

    	return response()->json(['event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with('eventDetails.addressBook.addressBookDetails.attendee')->find($id);
        // $event = Event::with('eventDetails.addressBook.addressBookDetails.attendee')
        //     ->whereHas('eventDetails', function($eventDetails) {
        //         $eventDetails->where('is_deleted', false)
        //     })->find($id);

        return response()->json(['event' => $event]);
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
