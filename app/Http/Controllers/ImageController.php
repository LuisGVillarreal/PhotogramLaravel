<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller{

    //Restrict only to authenticated users
	public function __construct(){
        $this->middleware('auth');
    }

    //Show the image upload form view
	public function create(){
		return view('image.create');
	}
}
