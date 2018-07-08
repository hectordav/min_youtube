<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', array('as' =>'home',
'uses' =>'HomeController@index'));


/* rutas del controlador de videos*/
Route::get('/crear-video', array('as' =>'createVideo',
'middelware' =>'auth',
'uses' =>'VideoController@createVideo'));

Route::post('/guardar-video', array(
'as' =>'saveVideo',
'middelware' =>'auth',
'uses' =>'VideoController@saveVideo'));

Route::get('/miniatura/{filename}', array(
'as' =>'imageVideo',
'uses' =>'VideoController@getImage'));

Route::get('/video/{video_id}', array(
'as' =>'detailVideo',
'uses' =>'VideoController@getVideoDetail'));

Route::get('/video-file/{filename}',array(
'as' =>'fileVideo',
'uses' =>'VideoController@getVideo'
 ));
Route::post('/comment',array(
'as' =>'comment',
'middelware' =>'auth',
'uses' =>'CommentController@store'
 ));
Route::get('/delete-video/{video_id}',array(
'as' =>'videoDelete',
'middelware' =>'auth',
'uses' =>'VideoController@delete'
 ));
Route::get('/editar-video/{video_id}',array(
'as' =>'videoEdit',
'middelware' =>'auth',
'uses' =>'VideoController@edit'
 ));
Route::post('/update-video/{video_id}',array(
'as' =>'update-video',
'middelware' =>'auth',  //si queremos autenticarlo
'uses' =>'VideoController@update'
 ));
Route::get('/buscar/{search?}/{filter?}',array(
'as' =>'videoSearch',
'uses' =>'VideoController@search'
 ));
/*usuarios*/
Route::get('/canal/{user_id}',array(
'as' =>'canalUsuario',
'uses' =>'UserController@channel'
 ));
/*comentarios*/
Route::get('/delete-comment/{comment_id}',array(
'as' =>'commentDelete',
'middelware' =>'auth',
'uses' =>'CommentController@delete'
 ));

