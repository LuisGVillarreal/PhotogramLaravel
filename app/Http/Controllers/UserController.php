<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller{

	//Restrict only to authenticated users
	public function __construct(){
        $this->middleware('auth');
    }

	//Show of config form view
	public function config(){
		return view('user.config');
	}

	//Get data from the configuration form
	public function update(Request $request){
		//Get user auth data
		$user = \Auth::user();
		$id = $user->id;

		//Validate data
		$validate = $this->validate($request, [
			'name' => ['required', 'string', 'max:255'],
			'surname' => ['required', 'string', 'max:255'],
			'nick' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($id)],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)]
		]);

		//Get user data
		$name = $request->input('name');
		$surname = $request->input('surname');
		$nick = $request->input('nick');
		$email = $request->input('email');

		//Get avatar
		$avatar = $request->file('avatar');
		if ($avatar) {
			//Set a unique name
			$avatar_path = time().$avatar->getClientOriginalName();
			//save in the 'Storage' folder (storage/app/avatar)
			Storage::disk('avatars')->put($avatar_path, File::get($avatar));
			//Set avatar name in the object
			$user->avatar = $avatar_path;
		}

		//Set data to new object and update
		$user->name = $name;
		$user->surname = $surname;
		$user->nick = $nick;
		$user->email = $email;
		$user->update();

		//Redirect
		return redirect()->route('config')
						 ->with(['message' => 'User successfully updated']);
	}

	//Get avatar
	public function getAvatar($filename){
		$file = Storage::disk('avatars')->get($filename);
		return new Response($file, 200);
	}

}
