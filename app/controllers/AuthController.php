<?php


class AuthController extends Controller {

    // --- login ---

    public function getLogin(){
        return View::make('login');
    }


    public function postLogin(){

        
        $mobile = Input::get('mobile');
        $password = Input::get('password');

        // remember me
        /*
        if( Auth::attempt(array('mobile'=>$mobile, 'password'=>$password),'true')){
            // login successful
            return Redirect::intended('check');
        } else {
            return Redirect::route('login');
            }*/

        if( Auth::attempt(array('mobile'=>$mobile, 'password'=>$password),'true') ){
            return Response::json(array('success'=>true));
        } else {
            return Response::json(array('success'=>false));
        }

    
    }


    // --- register ---

    public function getRegister(){
        return View::make('register');
    }


    public function postRegister(){

        $mobile = Input::get('mobile');
        $password = Input::get('password');

        $user = new User;
        $user->mobile = $mobile;
        $user->password = Hash::make($password);

        $user->save();
        
    }
    
    // --- logout ---
    public function getLogout(){
        Auth::logout();
        return Response::json(array('success' => true));
    }

    // --- check ---
    public function getCheck(){
        if( Auth::check() ){
            return Response::json(array('logined' => true));
        } else {
            return Response::json(array('logined' => false));
        }
    }



}