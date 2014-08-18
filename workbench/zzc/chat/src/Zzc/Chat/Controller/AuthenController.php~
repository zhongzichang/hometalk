<?php

namespace Zzc\Chat\Controller;

use Illuminate\Support\Facades\Hash;
use Zzc\Chat\Model\User;

class AuthenController
{
    public static function login($client, $data )
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