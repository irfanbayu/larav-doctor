<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

//use libraries here
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

//request
use App\Http\Requests\Doctor\StoreDoctorsRequest;
use App\Http\Requests\Doctor\UpdateDoctorsRequest;


//use everything here
// use Gate;
use Auth;

//use model here
use App\Models\Operational\Doctors;
use App\Models\MasterData\Specialists;

//thirdparty package


class DoctorsController extends Controller
{

    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
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
        //for table grid
        $doctors = Doctors::orderBy('created_at', 'desc')->get();

        //for select 2 = ascending a to z
        $specialists = Specialists::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctors.index', compact('doctors', 'specialists'));
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
    public function store(StoreDoctorsRequest $request)
    {
         // get all request from frontsite
        $data = $request->all();

        // store to database
        $doctors = Doctors::create($data);

        alert()->success('Success Message', 'Data has been saved!');
        return redirect()->route('backsite.doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctors $doctors)

    {
        return view('pages.backsite.operational.doctors.show', compact('doctors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctors $doctors)
    {
        //for select2 = ascending a to z
        $specialists = Specialists::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctors.edit', compact('doctors', 'specialists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorsRequest $request, Doctors $doctors)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $doctors->update($data);

        alert()->success('Success Message', 'Data has been updated!');
        return redirect()->route('backsite.doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctors $doctors)
    {
        $doctors->delete();

        alert()->success('Success Message', 'Data has been deleted!');
        return back();
    }
}
