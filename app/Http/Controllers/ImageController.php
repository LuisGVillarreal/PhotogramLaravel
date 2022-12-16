<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller{

    //Restrict only to authenticated users
	public function __construct(){
        $this->middleware('auth');
    }

    //Show the image upload form view
	public function create(){
		return view('image.create');
	}

	public function save(Request $request){
		//Validate
		$validate = $this->validate($request,[
			'description' => ['required', 'string'],
			'image_path' => ['required', 'image']
		]);

		//Get image data
		$image_path = $request->file('image_path');
		$description = $request->input('description');

		//Set data to new model object
		$user = \Auth::user();
		$image = new Image();
		$image->user_id = $user->id;
		$image->description = $description;

		//Upload image
		if ($image_path) {
			//Set a unique name
			$image_path_name = time().$image_path->getClientOriginalName();
			//save in the 'Storage' folder (storage/app/avatar)
			Storage::disk('images')->put($image_path_name, File::get($image_path));
			//Set avatar name in the object
			$image->image_path = $image_path_name;
		}
		$image->save();

		//Redirect
		return redirect()->route('home')
						 ->with(['message' => 'Image successfully uploaded']);
	}

	//Get image
	public function getImage($filename){
		$file = Storage::disk('images')->get($filename);
		return new Response($file, 200);
	}

	//Image detail
	public function detail($id){
		$image = Image::find($id);
		return view('image.detail',[
			'image' => $image
		]);
	}

	//Delete image
	public function delete($id){
		//Get data related to the image
		$user  = \Auth::user();
		$image = Image::find($id);
		$comments = Comment::where('image_id', $id)->get();
		$likes = Like::where('image_id', $id)->get();

		if ($user && $image && $image->user->id == $user->id) {
			//Delete comments
			if ($comments && count($comments)>=1) {
				foreach ($comments as $comment) {
					$comment->delete();
				}
			}

			//Delete Likes
			if ($likes && count($likes)>=1) {
				foreach ($likes as $like) {
					$like->delete();
				}
			}

			//Delete image
			Storage::disk('images')->delete($image->image_path);
			$image->delete();
			$message = array('message' => 'The image has been deleted correctly' );
		}else{
			$message = array('message' => 'The image has not been deleted correctly' );
		}

		return redirect()->route('home')
						->with($message);
	}

	//Show form to edit
	public function edit($id){
		$user  = \Auth::user();
		$image = Image::find($id);

		if ($user && $image && $image->user->id == $user->id) {
			return view('image.edit', [
				'image' => $image
			]);
		} else{
			return redirect()->route('home');
		}
	}

	public function update(Request $request){
		//Validate
		$validate = $this->validate($request,[
			'description' => ['required', 'string']
		]);

		//Get form data
		$image_id = $request->input('image_id');
		$description = $request->input('description');

		//Set data
		$image = Image::find($image_id);
		$image->description = $description;

		//Update
		$image->update();

		//Redirect
		return redirect()->route('image.detail', ['id' => $image_id])
						 ->with(['message' => 'Image successfully updated']);
	}

}
