<?php


class InvitationController extends BaseController {

    public function getIndex(){
        return View::make('invite');
    }
    

    public function postIndex(){

        $invitorId = Auth::id();
        $inviteeId = Input::get('invitee_id');
        $groupId = Input::get('group_id');
        $invitation = new Invitation();
        $invitation->invitor_id = $invitorId;
        $invitation->invitee_id = $inviteeId;
        $invitation->group_id = $groupId;
        $invitation->save();
        return 'Invited OK.';

    }

    public function getToMe()
    {
        $user = Auth::user();
        $invitations = Invitation::where('invitee_id', '=', $user->id)->get();
        return $invitations;
    }

    public function getFromMe()
    {
        $user = Auth::user();
        $invitations = Invitation::where('invitor_id','=',$user->id)->get();
        return $invitations;
    }

    public function getAgree()
    {
        $me = Auth::user();
        $invitation_id = Input::get('invitation_id');
        $invitation = Invitation::find($invitation_id);
        if( $invitation->invitee_id == $me->id ) {
            $group = Group::find($invitation->group_id);
            if( $group != null ){
                $group->members()->attach($me->id);
                $invitation->delete();
                return Response::json(array('success'=>true));
            } else {
                return Response::json(array('success'=>false, 'message'=>'group not found with id ' + $invitation->group_id));
            }
        } else {
            return Response::make('you are not invitee', 409);
        }
    }

    public function delete(){
    }

}