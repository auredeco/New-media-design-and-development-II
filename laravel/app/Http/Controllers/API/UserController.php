<?php

namespace App\Http\Controllers\API;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->gender = $request->input('gender');
        $user->birthdate = $request->input('birthdate');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->lastLogin = Carbon::now();

        $user->save();

        return 'User created with user id:' . $user->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::
            with('candidate')
            ->with('candidate.referendums')
            ->with('candidate.elections')
            ->with('voter')
            ->find($id);

        return $user ?: response()
            ->json([
                'error' => "User `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
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
        $user = User::find($id);

        $user->username = $user->username;
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->gender = $request->input('gender');
        $user->birthdate = $request->input('birthdate');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->updated_at = Carbon::now();
        $user->lastLogin = Carbon::now();

        $user->save();

        return 'User with id ' . $user->id . ' updated';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
