<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use App\Image;

Route::get('/', function () {
/*	$images = Image::all();
	foreach ($images as $image) {
		echo $image->image_path."<br>";
		echo $image->description."<br>";
		echo $image->user->name." ".$image->user->surname."<br>";

		if (count($image->comments) >= 1) {
			echo "<strong>Comentarios: </strong><br>";
			foreach ($image->comments as $comment) {
				echo "<strong>".$comment->user->name." ".$comment->user->surname.": </strong>";
				echo $comment->content."<br/>";
			}
		}
		echo "LIKES: ".count($image->likes);
		echo "<hr>";
	}
	die();*/

    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/config', 'UserController@config')->name('config');
Route::post('user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getAvatar')->name('user.avatar');


