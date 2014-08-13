<?php

class UserController extends BaseController {
    
    public function showProfile($id){
        $user = User::find($id);
        return $user;
    }

    public function getSearch(){
        $mobile = Input::get('mobile');
        if( $mobile != null ){
            $user = User::where('mobile','=',$mobile)->first();
            return $user;
        }
    }

    public function getMe()
    {
        return Auth::user();
    }

}