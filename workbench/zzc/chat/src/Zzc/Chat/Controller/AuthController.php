<?php

namespace Zzc\Chat\Controller;

use Illuminate\Support\Facades\Hash;
use Zzc\Chat\Cache;
use Zzc\Chat\Model\User;

class AuthController
{

    public function test($client, $data){
        return array('test'=>'test');
    }

    public function login($client, $data )
    {
        $username = $data->username;
        $password = $data->password;

        $user = User::where('username','=',$username)->first();
        if( $user != null ){
            $hashedPassword = $user->password;
            if (Hash::check($password, $hashedPassword)) {
                $client->setUser($user);
                Cache::$loginedClients[$user->id] = $client;
                return array('success'=>true);
            }
        }
        return array('success'=>false);
    }
    
}