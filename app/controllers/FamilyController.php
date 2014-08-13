<?php


class FamilyController extends BaseController {
    
    public function getIndex(){
        $userId = Auth::id();
        $families = Family::where('user_id','=',$userId)->take(100)->get();
        return Response::json($families);
    }

    public function getCreate(){
        return View::make('family.create');
    }

    public function postCreate(){
        $userId = Auth::id();
        $mobile = Input::get('mobile');
        $nickname = Input::get('nickname');
        $type = Input::get('type');
        
        $f = new Family();
        $f->user_id = $userId;
        $f->mobile = $mobile;
        $f->nickname = $nickname;
        $f->type = $type;
        $f->save();

        return Response::json(array('success'=>'true'));
        
    }


}