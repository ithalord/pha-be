<?php
namespace App\Http\Controllers\AddressBook;
ini_set('max_execution_time', 300);

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Year;
use App\Models\AddressBook;
use App\Models\EventDetail;

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
        $regions = $input['regions'];

        $regs = AddressBook::whereIn('region', $regions)->get();

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

        foreach($regs as $r) {
            $eventDetail = EventDetail::create([
                'address_book_id'   =>  $r['id'],
                'event_id'          =>  $event['id'],
                'is_attended'       =>  0
            ]);

            $hospital = AddressBook::find($r['id']);
            $hospital->is_attended = 1;
            $hospital->save();
        }

    	$event = Event::find($event->id);

    	return response()->json(['event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $q = $request['q'];

        $event = EventDetail::with('addressBook.addressBookDetails.attendee')
            ->where('event_id', $id)
            ->search($q)
            ->simplePaginate(10);

        return response()->json(['event' => $event]);
    }

    public function eventSummary($id)
    {
        $event = Event::with('eventDetailsIsAttendedOnly.addressBook.addressBookDetailsAttendingOnly.attendee')->find($id);

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
