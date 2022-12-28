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
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mimeType = finfo_buffer($finfo, $file);
		finfo_close($finfo);
		return response($file, 200)->header('Content-Type', $mimeType);
		/*return response($file, 200)->header('Content-Type', 'image/jpeg');*/
	}

	//Image detail
	public function detail($id){
		$image = Image::find($id);
		return view('image.detail', compact('image'));
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

	//Search content
	public function search($search = null){
		if (!empty($search)) {
			$images = Image::where('description', 'LIKE', '%'.$search.'%')
								->orderBy('id', 'desc')
								->paginate(5);
		}else{
			$images = Image::orderBy('id', 'desc')->paginate(5);
		}

		return view('image.explore', compact('images'));
	}

	//Search content
	public function tag($tag){
		$images = Image::where('description', 'LIKE', '%'.$tag.'%')
								->orderBy('id', 'desc')
								->paginate(5);
		return view('image.explore', compact('images','tag'));
	}

	//Api tag img
	public function getTagImg(Request $request){
		$image_id = $request->input('image_id');
		$image = Image::find($image_id);
		$file_path = Storage::disk('images')->path($image->image_path);
		$pathinfo = pathinfo($file_path);
		$api_credentials = array(
			'key' => env('IMAGGA_API_KEY'),
			'secret' => env('IMAGGA_API_SECRET')
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://api.imagga.com/v2/tags");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_USERPWD, $api_credentials['key'].':'.$api_credentials['secret']);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, 1);
		$fields = [
			'image' => new \CurlFile($file_path, 'image/jpeg', 'image.jpg')
		];
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		$response = curl_exec($ch);
		curl_close($ch);

		$json_response = json_decode($response);
		$tags = $json_response->result->tags;
		$tags = array_slice($tags, 0, 5);
		return redirect()->route('image.edit', ['id' => $image_id])
						 ->with(['message' => 'Successfully generated tags'])
						 ->with(['tagsTemp' => $tags]);
	}
}
