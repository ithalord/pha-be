<?php

namespace App\Http\Controllers\AddressBook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Year;

class YearsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::all();

        return response()->json(['years' => $years]);
    }

    public function changeCurrent($id)
    {
        $previous = Year::where('current', true)->first();
        if ($previous) {
            $previous->current = false;
            $previous->save();
        }

        $setting = Year::find($id);
        $setting->current = true;
        $setting->save();

        return response()->json(['years' => Year::all()]);
    }

    public function getCurrent()
    {
        $year = Year::with('events')->where('current', true)->first();

        return response()->json(['year' => $year]);
    }

    public function yearOnly()
    {
        $year = Year::where('current', true)->first();

        return response()->json(['year' => $year]);
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
            'from'          =>  'required',
            'to'            =>  'required',
            'description'   =>  'required'
        ));

        $year = Year::create($input);
        $year->save();
        $year = Year::find($year->id);

        return response()->json(['year' => $year]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $years = Year::with('events')->find($id);

        return response()->json(['years' => $years]);
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
