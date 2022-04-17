<?php

namespace App\Http\Controllers\Backsite;

// use library here
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\ConfigPayment\UpdateConfigPaymentsRequest;

// use everything here
// use Gate;
use Auth;

// use model here
use App\Models\MasterData\ConfigPayments;

// thirdparty package

class ConfigPaymenysController extends Controller
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
        $config_payments = ConfigPayments::all();

        return view('pages.backsite.master-data.config-payments.index', compact('config_payments'));
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
    public function edit(ConfigPayments $config_payments)
    {
        return view('pages.backsite.master-data.config-payments.edit', compact('config_payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigPaymentsRequest $request, ConfigPayments $config_payments)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $config_payments->update($data);

        alert()->success('Success Message', 'Successfully updated config payment');
        return redirect()->route('backsite.config_payments.index');
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
}
