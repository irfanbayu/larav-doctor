<?php

use Illuminate\Support\Facades\Route;

//frontsite
use App\Http\Controllers\Frontsite\AppointmentsController;
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\PaymentsController;

//backsite
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\SpecialistsController;
use App\Http\Controllers\Backsite\TypeUsersController;



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
    Route::resource('appointment', AppointmentsController::class);

    // payment page
    Route::resource('payment', PaymentsController::class);
});


//prefix backsite
Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum','verified']], function () {

    // dashboard page
    Route::resource('dashboard', DashboardController::class);

    // type users page
    Route::resource('type_users', TypeUsersController::class);

     // type users page
    Route::resource('specialists', SpecialistsController::class);

});


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
