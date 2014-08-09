<?php
class AuthenticationController extends \BaseController {
	public function index(){
		Auth::logout();
        return Response::json(['flash' => 'you have been disconnected'],200);
	}
	public function store(){
		$credentials = ['username' =>  Input::get('username'),
            			'password' =>  Input::get('password')];
        if ( Auth::attempt($credentials) ) {
            $token = Hash::make(str_random(64));
            Session::put('auth_token', $token);
            return Response::json(['user' => Auth::user()->toArray()],202)->withCookie(Cookie::make('auth_token', $token, 10));
            return Response::json(['user' => Auth::user()->toArray()],202);
        }else{
            return Response::json(['flash' => 'Authentication failed'],401);
        }
	}
}
