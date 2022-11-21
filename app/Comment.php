<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
	
    //Table
	protected $table = 'comments';

    //Relation: Many To One
	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	//Relation: Many To One
	public function image(){
		return $this->belongsTo('App\Image', 'image_id');
	}
}
