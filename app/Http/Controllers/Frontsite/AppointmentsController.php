<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;

//use library here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

//use everything here
// use Gate;
// use File;
use Auth;

//use model here
use App\Models\User;
use App\Models\Operational\Doctors;
use App\Models\Operational\Appointments;
use App\Models\MasterData\Specialists;
use App\Models\MasterData\Consultations;

// third party package

class AppointmentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.frontsite.appointment.index');
        return abort(404);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
        $data = $request->all();

        $appointment = new Appointments;
        $appointment->doctors_id = $data['doctors_id'];
        $appointment->users_id = Auth::user()->id;
        $appointment->consultatations_id = $data['consultations_id'];
        $appointment->level = $data['level_id'];
        $appointment->date = $data['date'];
        $appointment->time = $data['time'];
        $appointment->status = 2; // set to waiting payment
        $appointment->save();

        return redirect()->route('payment.appointment', $appointment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);

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
        return abort(404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    // custom

    public function appointment($id)
    {
        $doctor = Doctors::where('id', $id)->first();
        $consultation = Consultations::orderBy('name', 'asc')->get();

        return view('pages.frontsite.appointment.index', compact('doctors', 'consultations'));
    }
}
