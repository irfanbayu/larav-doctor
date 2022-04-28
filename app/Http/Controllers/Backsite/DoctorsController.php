<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//request
use App\Http\Requests\Doctor\StoreDoctorsRequest;
use App\Http\Requests\Doctor\UpdateDoctorsRequest;


//use everything here
use Gate;
use Auth;
use File;

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
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //for table grid
        $doctors = Doctors::orderBy('created_at', 'desc')->get();

        //for select 2 = ascending a to z
        $specialists = Specialists::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.index', compact('doctors', 'specialists'));
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

        // re format before push to table
        $data['fee'] = str_replace(',', '', $data['fee']);
        $data['fee'] = str_replace('IDR ', '', $data['fee']);

        // upload process here
        $path = public_path('app/public/assets/file-doctor');
        if(!File::isDirectory($path)){
            $response = Storage::makeDirectory('public/assets/file-doctor');
        }

        // change file locations
        if(isset($data['photo'])){
            $data['photo'] = $request->file('photo')->store(
                'assets/file-doctor', 'public'
            );
        }else{
            $data['photo'] = "";
        }

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
        abort_if(Gate::denies('doctors_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.operational.doctor.show', compact('doctors'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctors $doctors)
    {
        abort_if(Gate::denies('edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //for select2 = ascending a to z
        $specialists = Specialists::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.edit', compact('doctors', 'specialists'));
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

        // re format before push to table
        $data['fee'] = str_replace(',', '', $data['fee']);
        $data['fee'] = str_replace('IDR ', '', $data['fee']);

        // upload process here
        // change format photo
        if(isset($data['photo'])){

             // first checking old photo to delete from storage
            $get_item = $doctors['photo'];

            // change file locations
            $data['photo'] = $request->file('photo')->store(
                'assets/file-doctor', 'public'
            );

            // delete old photo from storage
            $data_old = 'storage/'.$get_item;
            if (File::exists($data_old)) {
                File::delete($data_old);
            }else{
                File::delete('storage/app/public/'.$get_item);
            }

        }

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
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // first checking old file to delete from storage
        $get_item = $doctors['photo'];

        $data = 'storage/'.$get_item;
        if (File::exists($data)) {
            File::delete($data);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }

        $doctors->forceDelete();

        alert()->success('Success Message', 'Data has been deleted!');
        return back();
    }
}
