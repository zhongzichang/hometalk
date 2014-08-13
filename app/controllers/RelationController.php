<?php


class RelationController extends Controller {

    
    public function postRequest(){
        
        $otherId = Input::get('other_id');
        
        $req = new RelationRequest();
        $req->userId = Auth::id();
        $req->otherId = $otherId;
        $req->save();
    }


    public function getAccept(){

        $reqId = Input::get('req_id');
        
        $req = RelationRequest::find($reqId);
        
        $relation = new Relation();
        $relation->userId = Auth::id();
        $relation->otherId = $req->otherId;
        $relatioin->save();
    }

}