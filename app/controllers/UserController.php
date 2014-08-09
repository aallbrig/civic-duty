<?php

class UserController extends \BaseController {
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
		return User::with('activities')->get();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){
		// create new user
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){ 
		return User::with('activities')->find($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){
		$user = User::find(Auth::user()->id);
		$activity = Activity::find(Input::get('aid'));
		foreach ($user->activities as $a) {
			if($a->id == $activity->id){
				return Response::json(['error' => 'already completed!']);
			}
		}
		// return Response::json(['error' => 'still need to complete!']);
		$user->activities()->attach($activity->id);
		$user->points += $activity->points;
  		$user->morality += $activity->morality;
      	$user->reputation += 1;
      	$user->save();
		return Response::json(['success'=>'Successfully completed!']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
		//
	}


}
