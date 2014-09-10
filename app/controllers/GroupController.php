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

    public function listMyGroups(){
        $user = Auth::user();
        $groups = $user->groups;

        $rest_groups = array();
        $counter = 0;
        foreach($groups as $group){
            $rest_groups[$counter] = array("id"=>$group->id, "name"=>$group->name, "desc"=>$group->desc);
        }

        return Response::json($rest_groups);

    }

}
