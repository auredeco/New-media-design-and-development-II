<?php

namespace App\Http\Controllers;

use App\Models\Referendum;
use Illuminate\Http\Request;

class ReferendumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword != '') {

            switch (strtolower($keyword)){
                case 'open':{
                    $referenda = Referendum::WhereOpen()->paginate(10);
                    $referenda->withPath('referenda?keyword=open');

                }break;
                case 'all':{
                    $referenda = Referendum::orderBy('id','asc')->paginate(10);
                    $referenda->withPath('referenda?keyword=all');

                }break;
                case 'closed':{
                    $referenda = Referendum::WhereClosed()->paginate(10);
                    $referenda->withPath('referenda?keyword=closed');

                }break;
                case 'published':{
                    $referenda = Referendum::WherePublished()->paginate(10);
                    $referenda->withPath('referenda?keyword=published');


                }break;
                case 'unpublished':{
                    $referenda = Referendum::WhereUnpublished()->paginate(10);
                    $referenda->withPath('referenda?keyword=unpublished');

                }break;
                default : {
                    $referenda = Referendum::SearchByKeyword($keyword)->paginate(10);
                    $referenda->withPath('referenda?keyword=' . strtolower($keyword));
                }
            }
        }
        else
        {
            $referenda = Referendum::orderBy('id','asc')->paginate(10);
            $referenda->withPath('referenda?keyword=all');

        }
        return view('referenda', compact('referenda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $referendum = Referendum::find($id);
        return view('detail.referendum', compact('referendum'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
