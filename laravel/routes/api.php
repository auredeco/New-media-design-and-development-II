<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'middleware' => [
        'cors',
    ],
    'namespace' => 'API',
], function () {
    $options = [
        'except' => [
            'create',
            'edit',
        ]
    ];
    Route::resource('users', 'UserController', $options);
    Route::resource('elections', 'ElectionController', $options);
    Route::resource('parties', 'PartyController', $options);
    Route::resource('referenda', 'ReferendumController', $options);
    Route::resource('groups', 'GroupController', $options);
    Route::resource('votes', 'VoteController', $options);
});

    Route::get('user', function(Request $request) {
        return 	Auth::guard('api')->user();
    })->middleware('auth:api');
