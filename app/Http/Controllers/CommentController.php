<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller{

    //Restrict only to authenticated users
	public function __construct(){
        $this->middleware('auth');
    }

    //
    public function save(Request $request){
    	//Validate
		$validate = $this->validate($request,[
			'image_id' => ['required', 'integer'],
			'content' => ['required', 'string']
		]);

		//Get form data
		$user = \Auth::user();
    	$image_id = $request->input('image_id');
    	$content = $request->input('content');

    	//Set data to new model object
    	$comment = new Comment();
    	$comment->user_id = $user->id;
    	$comment->image_id = $image_id;
    	$comment->content = $content;

    	$comment->save();

    	//Redirect
    	return redirect()->route('image.detail', ['id' => $image_id])
    					 ->with(['message' => 'Your comment has been posted!']);
    }

    //Delete comments
    public function delete($id){
    	$user = \Auth::user();

    	$comment = Comment::find($id);

    	if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
    		$comment->delete();
    		return redirect()->route('image.detail', ['id' => $comment->image->id])
    					 ->with(['message' => 'Comment deleted!']);
    	}
    	else{
    		return redirect()->route('image.detail', ['id' => $comment->image->id])
    					 ->with(['message' => 'Error while deleting a comment!']);
    	}
    }
}
