<?php

namespace App\Http\Controllers\AddressBook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;

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
        $previous = Event::where('current', true)->first();
        if ($previous) {
            $previous->current = false;
            $previous->save();
        }

        $setting = Event::find($id);
        $setting->current = true;
        $setting->save();

        return response()->json(Event::all());
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
        $event = Event::find($id);

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
