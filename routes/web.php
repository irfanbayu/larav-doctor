<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontsite\AppointmentsController;
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\PaymentsController;

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

    return view('dashboard');

});


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
