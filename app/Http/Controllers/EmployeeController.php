<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\OvertimePayRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\OvertimePayResource;
use App\Models\Employee;
use App\Models\Overtime;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    private $employees;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->employees = Employee::all();
        $employeeResource = EmployeeResource::collection($this->employees);
        return $this->sendResponse($employeeResource, "Successfully get employees!");
    }

    public function calculate(OvertimePayRequest $request) 
    {
        $this->employees = Employee::all();
        $employeeResource = OvertimePayResource::collection($this->employees);
        return $this->sendResponse($employeeResource, "Successfully get overtime pays!");
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
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->salary = $request->salary;

        $employee->save();

        return $this->sendResponse(new EmployeeResource($employee), "Employee posted successfully!");
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
