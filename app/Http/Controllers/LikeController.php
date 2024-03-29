<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller{
	//Restrict only to authenticated users
	public function __construct(){
		$this->middleware('auth');
	}

	//My likes
	public function index(){
		$user = \Auth::user();
		$likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')
							  ->paginate(5);
		return view('like.mylikes', [
            'likes' => $likes
        ]);
	}

	//like
	public function like($image_id){
		$user =  \Auth::user();

		//Check if the "Like" exists & don't duplicate it
		$isset_like = Like::where('user_id',$user->id)->where('image_id',$image_id)->count();
		if ($isset_like == 0) {
			$like = new Like();
			$like->user_id = $user->id;
			$like->image_id = (int)$image_id;

			//Save like
			$like->save();
			return response()->json([
				'like' => $like
			]);
		} else {
			return response()->json([
				'message' => 'you have already given a like'
			]);
		}
	}

	//dislike
	public function dislike($image_id){
		$user =  \Auth::user();

		//Check if the "Like" exists & don't duplicate it
		$like = Like::where('user_id',$user->id)->where('image_id',$image_id)->first();
		if ($like) {
			$like->delete();
			return response()->json([
				'like' => $like,
				'message' => 'You have given a dislike'
			]);
		} else {
			return response()->json([
				'message' => 'Error'
			]);
		}
	}

}
