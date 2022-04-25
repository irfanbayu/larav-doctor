<?php

use Illuminate\Support\Facades\Route;

//frontsite
use App\Http\Controllers\Frontsite\AppointmentsController;
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\PaymentsController;

// backsite
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\PermissionsController;
use App\Http\Controllers\Backsite\RolesController;
use App\Http\Controllers\Backsite\UsersController;
use App\Http\Controllers\Backsite\TypeUsersController;
use App\Http\Controllers\Backsite\SpecialistsController;
use App\Http\Controllers\Backsite\ConfigPaymentsController;
use App\Http\Controllers\Backsite\ConsultationsController;
use App\Http\Controllers\Backsite\DoctorsController;
use App\Http\Controllers\Backsite\HospitalPatientsController;
use App\Http\Controllers\Backsite\ReportAppointmentsController;
use App\Http\Controllers\Backsite\ReportTransactionsController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', LandingController::class);


//prefix frontsite
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    // appointment page
    Route::get('/appointment/doctor/{id}', [AppointmentsController::class . 'appointment'])->name('appointment.doctor');
    Route::resource('appointment', AppointmentsController::class);

    // payment page
    Route::get('payment/success', [PaymentsController::class, 'success'])->name('payment.success');
    Route::get('payment/appointment/{id}', [PaymentsController::class, 'payment'])->name('payment.appointment');
    Route::resource('payment', PaymentsController::class);
});


//prefix backsite
Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum','verified']], function () {

    // dashboard page
    Route::resource('dashboard', DashboardController::class);

    // permissions page
    Route::resource('permissions', PermissionsController::class);

    // roles page
    Route::resource('roles', RolesController::class);

    // users page
    Route::resource('users', UsersController::class);

    // type users page
    Route::resource('type_users', TypeUsersController::class);

     // type users page
    Route::resource('specialists', SpecialistsController::class);

    // config payments page
    Route::resource('config_payments', ConfigPaymentsController::class);

    // consultations page
    Route::resource('consultations', ConsultationsController::class);

    // doctors page
    Route::resource('doctors', DoctorsController::class);

    // hospital patients page
    Route::resource('hospital_patients', HospitalPatientsController::class);

    // report appointments page
    Route::resource('appointments', ReportAppointmentsController::class);

    // report transactions page
    Route::resource('transactions', ReportTransactionsController::class);

});


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
