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