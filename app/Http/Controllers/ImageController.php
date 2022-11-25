<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;

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
}
