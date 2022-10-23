<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\OvertimeRequest;
use App\Http\Resources\OvertimeResource;
use App\Models\Employee;
use App\Models\Overtime;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{

    private $overtimes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->overtimes = Overtime::all();
        $overtimeResource = OvertimeResource::collection($this->overtimes);
        return $this->sendResponse($overtimeResource, "Overtimes get successfully!");
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
    public function store(OvertimeRequest $request)
    {
        $overtime = new Overtime();
        $overtime->employee_id = $request->employee_id;
        $overtime->date = $request->date;
        $overtime->time_started = $request->time_started;
        $overtime->time_ended = $request->time_ended;

        $overtime->save();

        return $this->sendResponse(new OvertimeResource($overtime), "Overtime posted successfully!");
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
