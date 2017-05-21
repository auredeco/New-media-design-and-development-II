<?php

namespace App\Http\Controllers\API;

use App\Models\Referendum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ReferendumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Referendum::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $referendum = new Referendum();

        $referendum->title = $request->input('title');
        $referendum->description = $request->input('description');
        $referendum->isClosed = $request->input('isClosed');
        $referendum->startDate = $request->input('startDate');
        $referendum->endDate = $request->input('endDate');
        $referendum->published = $request->input('published');
        $referendum->candidate_id = $request->input('candidate_id');
        $referendum->group_id = $request->input('group_id');
        $referendum->votemanager_id = $request->input('votemanager_id');

        $referendum->save();

        return 'Referendum created!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $referendum = Referendum::
            with('candidate')
            ->with('candidate.user')
            ->with('candidate.party')
            ->with('group')
            ->with('votes')
            ->find($id);

        return $referendum ?: response()
            ->json([
                'error' => "Referendum `${id}` not found",
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
        $referendum = Referendum::find($id);

        //check input from request and change in the table if needed
        if($request->input('title') == null || $referendum->title == $request->input('title') ||
            $request->input('title') == '')
        {
            $referendum->title = $referendum->title;
        } else {
            $referendum->title = $request->input('title');
        }

        if($request->input('description') == null || $referendum->description == $request->input('description') ||
            $request->input('description') == '')
        {
            $referendum->description = $referendum->description;
        } else {
            $referendum->description = $request->input('description');
        }

        if($request->input('startDate') == null || $referendum->startDate == $request->input('startDate') ||
            $request->input('startDate') == '')
        {
            $referendum->startDate = $referendum->startDate;
        } else {
            $referendum->startDate = $request->input('startDate');
        }

        if($request->input('endDate') == null || $referendum->endDate == $request->input('endDate') ||
            $request->input('endDate') == '')
        {
            $referendum->endDate = $referendum->endDate;
        } else {
            $referendum->endDate = $request->input('endDate');
        }

        if($request->input('isClosed') == null || $referendum->isClosed == $request->input('isClosed') ||
            $request->input('isClosed') == '')
        {
            $referendum->isClosed = $referendum->isClosed;
        } else {
            $referendum->isClosed = $request->input('isClosed');
        }

        if($referendum->published == $request->input('published') ||
            $request->input('published') == '')
        {
            $referendum->published = $referendum->published;
        } else {
            $referendum->published = $request->input('published');
        }

        $referendum->save();

        return 'Referendum with id ' . $referendum->id . ' updated';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $referendum = Referendum::find($id);

        if ($referendum) {
            if ($referendum->delete()) {
                return response()
                    ->json($referendum)
                    ->setStatusCode(Response::HTTP_OK);
            }

            return response()
                ->json([
                    'error' => "Referendum `${id}` could not be deleted",
                ])
                ->setStatusCode(Response::HTTP_CONFLICT);
        }

        return response()
            ->json([
                'error' => "Referendum `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }
}
