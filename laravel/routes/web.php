<?php
use App\User;
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
Route::group(['prefix' => 'backoffice'], function () {
    Route::get('/', 'DashboardController@index')->middleware('auth');
    Route::resource('users', 'UserController');
    Route::resource('parties', 'PartyController');
    Route::resource('referenda', 'ReferendumController');
    Route::resource('elections', 'ElectionController');
    Route::resource('groups', 'GroupController');
    Route::get('/settings', function () {
        return view('settings');
    });
});

//Route::get('/', 'DashboardController@index')->middleware('auth');
//Route::resource('users', 'UserController');
//Route::resource('parties', 'PartyController');
//Route::resource('referenda', 'ReferendumController');
//Route::resource('elections', 'ElectionController');
//Route::resource('groups', 'GroupController');



Auth::routes();

Route::get('/', 'HomeController@index')->middleware(null);
