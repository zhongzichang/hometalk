<?php

class MessageController extends \BaseController {

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
        return View::make('message/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $from_id = Auth::user()->id;
        $res_uuid = uniqid(Str::random(), true);
        $res_type = Input::get('res_type');
        $res_dir = "/home/zzc/www/static/hometalk/";
        $group_id = Input::get('group_id');
        if( Input::hasFile('file') ) {
            $file = Input::file('file');
            // save file
            $file->move(public_path() .'/uploads/' , $res_uuid);
            // save data
            $m = new Message();
            $m->from_id = $from_id;
            $m->res_uuid = $res_uuid;
            $m->res_type = $res_type;
            $m->group_id = $group_id;
            $m->save();
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
        $file= public_path(). "/uploads/".$id;
        $headers = array(
            'Content-Type: audio/mpeg',
        );
        return Response::download($file, 'filename.mp3', $headers);        
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

    public function getByGroup($groupId){
    }


}
