<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

/*Route::get('/', function () {

    $images = Image::all();

    foreach($images as $image){

        var_dump( $image->id);
        echo '<br>';

        echo 'Comentarios<br>';
        foreach($image->comments as $comment){
            echo $comment->content;
            echo '<br>';
            echo $comment->user->name;
            echo '<br>';
        }
        echo 'Likes = ' . count($image->likes);
        echo '<hr>';
    }
    die;
    return view('home');
});*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/profile/{id}', 'UserController@profile')->name('user.profile');

Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');

Route::get('/personas/{search?}', 'UserController@users')->name('user.index');


//Rutas de ImageController
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/imagen/update', 'ImageController@update')->name('image.update');

//Rutas para comentarios
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//Rutas para likes
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');

Route::get('/likes', 'LikeController@likes')->name('like.likes');
