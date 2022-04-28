<?php

namespace App\Http\Controllers\Backsite;

// use library here
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\Consultation\StoreConsultationsRequest;
use App\Http\Requests\Consultation\UpdateConsultationsRequest;

// use everything here
use Gate;
use Auth;

// use model here
use App\Models\MasterData\Consultations;

// thirdparty package

class ConsultationsController extends Controller
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
        abort_if(Gate::denies('consultation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultations = Consultations::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.master-data.consultation.index', compact('consultations'));
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
    public function store(StoreConsultationsRequest $request)
    {
        //get all request from frontsite
        $data = $request->all();

        //store to database
        $consultations = Consultations::create($data);

        alert()->success('Success', 'Data has been added new Consultation!');
        return redirect()->route('backsite.consultations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Consultations $consultations)
    {
        abort_if(Gate::denies('consultation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.master-data.consultation.show', compact('consultations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultations $consultations)
    {
        abort_if(Gate::denies('consultation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.master-data.consultation.edit', compact('consultations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultationsRequest $request, Consultations $consultations)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $consultations->update($data);

        alert()->success('Success Message', 'Successfully updated Consultation');
        return redirect()->route('backsite.consultations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultations $consultations)
    {
        abort_if(Gate::denies('consultation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultations->forceDelete();

        alert()->success('Success Message', 'Successfully deleted Consultation');
        return back();
    }
}
