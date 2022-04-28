<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

//use libraries here
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

//request
use App\Http\Requests\Specialist\StoreSpecialistsRequest;
use App\Http\Requests\Specialist\UpdateSpecialistsRequest;


//use everything here
use Gate;
// use File;
use Auth;

//use model here
use App\Models\MasterData\Specialists;

class SpecialistsController extends Controller
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
        abort_if(Gate::denies('specialist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialists = Specialists::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.master-data.specialist.index', compact('specialists'));

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
    public function store(StoreSpecialistsRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // re format before push to table
        $data['price'] = str_replace(',', '', $data['price']);
        $data['price'] = str_replace('IDR ', '', $data['price']);

        // store to database
        $specialists = Specialists::create($data);

        alert()->success('Success Message', 'Data has been saved!');
        return redirect()->route('backsite.specialists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Specialists $specialists)
    {
        abort_if(Gate::denies('specialist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.master-data.specialist.show', compact('specialists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('specialist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.master-data.specialist.edit', compact('specialists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecialistsRequest $request, Specialists $specialists)
    {
        // get all request from frontsite
        $data = $request->all();

        $data['price'] = str_replace(',', '', $data['price']);
        $data['price'] = str_replace('IDR ', '', $data['price']);

        // update to database
        $specialists->update($data);

        alert()->success('Success Message', 'Data has been updated!');
        return redirect()->route('backsite.specialists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialists $specialists)
    {
        abort_if(Gate::denies('specialist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialists->forceDelete();

        alert()->success('Success Message', 'Data has been deleted!');
        return back();
    }
}
