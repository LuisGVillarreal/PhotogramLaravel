<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model{

	//Table
	protected $table = 'images';

    //Relation: One To Many
	public function comments(){
		return $this->hasMany('App\Comment');
	}

    //Relation: One To Many
	public function likes(){
		return $this->hasMany('App\Like');
	}

    //Relation: Many To One
	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}
}
