<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller{

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

    	//Assign data to new object and update
    	$user->name = $name;
    	$user->surname = $surname;
    	$user->nick = $nick;
    	$user->email = $email;
    	$user->update();

    	//Redirect
    	return redirect()->route('config')
    					 ->with(['message' => 'User successfully updated']);
    }
}
