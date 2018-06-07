<?php

namespace App\Http\Controllers\Leave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Leave\Employee;
use App\User;
use Bican\Roles\Models\Role;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['employees' => Employee::all()]);
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
        $role_id = $input['role_id'];

        $employee = Employee::create($input);
        $employee->save();

        $mi = explode(' ', $employee['middlename']);
        $initial = '';
        if (count($mi) > 1) {
            foreach ($mi as $m) {
                $initial .= substr($m, 0, 1);
            }
        } else {
            $initial .= substr($employee['middlename'], 0, 1);
        }

        $suffix = $employee['suffixname'] ? $employee['suffixname'] : '';

        $fullname = $employee['designation'] . ' ' . $employee['firstname'] . ' ' . $initial . '. ' . $employee['lastname'] . ' ' . $suffix;

        $user = User::create([
            'name'          =>      $fullname,
            'email'         =>      $input['email'],
            'password'      =>      'user',
            'employee_id'   =>      $employee['id'],
            'previlege_id'  =>      $input['previlege_id']
        ]);

        $role = Role::find($role_id);
        $user->attachRole($role);

        return response()->json(['employee' => $employee]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::with('leave.leaveDetails.leaveType')->find($id);

        return response()->json(['employee' => $employee]);
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
