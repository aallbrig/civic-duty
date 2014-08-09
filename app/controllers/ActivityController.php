<?php

class ActivityController extends \BaseController {
	public function __construct()
    {
        $this->beforeFilter('serviceAuth');
        $this->beforeFilter('serviceCSRF');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		return Activity::all();
	}
	public function create(){
		//
	}
	public function store(){
		//
		$validator = Activity::validator();
		return $validator;
		// return "ABCDEFAKLSJFASJKL";
		// return Input::all();
		// return Activity::find(1);
	}
	public function show($id){
		return Activity::find($id);
	}
	public function edit($id){
		//
	}
	public function update($id){
		//
	}
	public function destroy($id){
		//
	}
}
