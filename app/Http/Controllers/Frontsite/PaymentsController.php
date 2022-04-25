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
use App\Models\Operational\Transactions;
use App\Models\MasterData\Consultations;
use App\Models\MasterData\ConfigPayments;
use App\Models\MasterData\Specialists;

// third party package

class PaymentsController extends Controller
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
        return view('pages.frontsite.payment.index');
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

         $appointment = Appointments::where('id', $data['appointments_id'])->first();
         $config_payment = ConfigPayments::first();

         // set transaction
         $specialist_fee = $appointment->doctors->specialists->price;
         $doctor_fee = $appointment->doctors->fee;
         $hospital_fee = $config_payment->fee;
         $hospital_vat = $config_payment->vat;

         // total
         $total = $specialist_fee + $doctor_fee + $hospital_fee;

         // total with vat and grand total
         $total_with_vat = ($total * $hospital_vat) / 100;
         $grand_total = $total + $total_with_vat;

         // save to database
        $transaction = new Transactions;
        $transaction->appointments_id = $appointment['id'];
        $transaction->fee_doctor = $doctor_fee;
        $transaction->fee_specialist = $specialist_fee;
        $transaction->fee_hospital = $hospital_fee;
        $transaction->sub_total = $total;
        $transaction->vat = $hospital_vat;
        $transaction->total = $grand_total;
        $transaction->save();

        // update status appointment
        $appointment = Appointments::find($appointment->id);
        $appointment->status = 1; // set to completed payment
        $appointment->save();

        return redirect()->route('payment.success');
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


    //custom

     public function payment($id)
    {
        $appointment = Appointments::where('id', $id)->first();
        $config_payment = ConfigPayments::first();

        // set value
        $specialist_fee = $appointment->doctors->specialists->price;
        $doctor_fee = $appointment->doctors->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        $total_with_vat = ($total * $hospital_vat) / 100;
        $grand_total = $total + $total_with_vat;

        return view('pages.frontsite.payment.index', compact('appointments', 'config_payments', 'total_with_vat', 'grand_total', 'id'));
    }

    public function success()
    {
        return view('pages.frontsite.success.payment-success');
    }
}
