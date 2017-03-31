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

Route::get('/', 'DashboardController@index');

Route::get('/users', 'UserController@index');
Route::get('/users/{user}', 'UserController@detail');

Route::get('/parties', 'PartyController@index');
Route::get('/parties/{party}', 'PartyController@detail');

Route::get('/referenda', 'ReferendumController@index');
Route::get('/referenda/{referendum}', 'ReferendumController@detail');

Route::get('/elections', 'ElectionController@index');
Route::get('/elections/{election}', 'ElectionController@detail');

Route::get('/groups', 'GroupController@index');
Route::get('/groups/{group}', 'GroupController@detail');

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/login', function () {
    return view('login');
});
