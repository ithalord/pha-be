<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\Models\DirectoryDetail;

class DirectoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directories = Directory::with('directoryDetails.directoryNumbers.ditectoryNumberType')->get();

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
        $input = $request->all();

        $this->validate($request, array(
            'address' => 'required',
            'person' => 'required',
        ));

        $directory = Directory::create($input);
        $directory->save();

        $directoryDetails = $request->input('directory_details');

        foreach($directoryDetails as $dd) {
            $directory->directoryDetails()->save(
                new DirectoryDetail($dd));
        }

        $directory = Directory::with('directoryDetails.directoryNumbers.ditectoryNumberType')->find($directory->id);

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
