<?php

namespace Zzc\Chat\Controller;

use Illuminate\Support\Facades\Hash;
use Zzc\Chat\Model\User;

class AuthController
{
    /*
    public function test(){
        return json_encode(array('test'=>'test'));
        }*/

    public function test($client, $data){
        return json_encode(array('test'=>'test'));
    }

    public function login($client, $data )
    {

        $username = $data->username;
        $password = $data->password;

        $user = User::where('username','=',$username)->first();
        if( $user != null ){
            $hashedPassword = $user->password;
            if (Hash::check($password, $hashedPassword)) {
                // The passwords match...
                return json_encode(array('success'=>true));
            }
        }

        return json_encode(array('success'=>false));
        
    }
    
}