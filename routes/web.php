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
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/{id}', 'UserController@profile')->name('profile');
Route::get('/user/avatar/{filename}', 'UserController@getAvatar')->name('user.avatar');
Route::get('/upload', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/image/detail/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/mylikes', 'LikeController@index')->name('likes');








