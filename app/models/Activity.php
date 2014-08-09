<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Activity extends Eloquent {

    protected $table = 'activities';
    public $timestamps = false;
    public function users(){
    	return $this->belongsToMany('User', 'users_activities');
    }
    public static function validator(){
    	// return Validator::make(
    	// 	['title'=>'required']
    	// );
    	return "ABCDEFG";
    }
}