<?php

namespace Zzc\Chat\Controller;

use Illuminate\Support\Facades\Hash;
use Zzc\Chat\Cache;
use Zzc\Chat\Model\User;
use Zzc\Chat\Model\Group;


class MessageController
{

    public function test($client, $data){
        return array('test'=>'test');
    }

    public function send($client, $data )
    {
        $user = $client->getUser();
        // must logined
        if( $user != null ){
            $groupId = $data->group_id;
            $resUuid = $data->res_uuid;
            $group = Group::find($groupId);
            foreach($group->members as $member){
                if( array_key_exists( $member->id, Cache::$loginedClients) ){
                    Cache::$loginedClients[$member->id]->getSocket()->send(
                        json_encode([
                            "user" => [
                                "id" => $user->id,
                                "username" => $user->username
                            ],
                            "message" => $data
                        ])
                    );
                }
            }
            return ['success'=>true];
        } else {
            return ['success'=>false, 'msg'=>'not logined'];
        }
    }
}