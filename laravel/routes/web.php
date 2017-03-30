<?php

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

use App\Models\Party;

Route::get('/', function () {

    $candidates = Party::find(1)->candidates;

    //return $candidates;
    return view('welcome', compact('candidates'));
});
