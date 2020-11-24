<?php

use App\Http\Controllers\RoadsideAssistance;
use App\Http\Controllers\VehicleTransportation;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/roadside-assistance', [RoadsideAssistance::class, 'index']);
Route::get('/roadside-assistance/cancel', [RoadsideAssistance::class, 'cancel']);

Route::resource('/transportations', VehicleTransportation::class)->only(['index', 'create', 'store', 'destroy']);
