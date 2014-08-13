<?php

class GroupController extends BaseController {

    public function getCreate(){
        return View::make('group.create');
    }

    public function postCreate(){

        $creatorId = Auth::id();
        $name = Input::get('name');
            
        $home = new Group();
        $home->creator_id = $creatorId;
        $home->name = $name;
        $home->save();

        return Response::json(array('success'=>true));
    }

}
