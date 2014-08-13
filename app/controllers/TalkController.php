<?php

class TalkController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('talk/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user_id = Auth::user()->id;
        $res_uuid = uniqid(Str::random(), true);
        $res_type = Input::get('res_type');
        $res_dir = "/home/zzc/www/static/hometalk/";
        $group_id = Input::get('group_id');
        if( Input::hasFile('file') ) {
            $file = Input::file('file');
            // save file
            $file->move(public_path() .'/uploads/' , $res_uuid);
            // save data
            $talk = new Talk();
            $talk->user_id = $user_id;
            $talk->res_uuid = $res_uuid;
            $talk->res_type = $res_type;
            $talk->group_id = $group_id;
            $talk->save();
            return Response::json(array('success'=>true));
        } else {
            return Response::json(array('success'=>false));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
