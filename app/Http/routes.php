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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::get('/home', 'PagesController@home');
Route::get('/master', 'PagesController@master');
Route::get('/ticket/{slug?}', 'TicketsController@show');
Route::get('/ticket/{slug?}/delete', 'TicketsController@destroy');
Route::get('/ticket/{slug?}/edit', 'TicketsController@edit');
Route::get('/tickets', 'TicketsController@index');
Route::get('/users/login', 'Auth\AuthController@getLogin');
Route::get('/users/logout', 'Auth\AuthController@getLogout');
Route::get('/users/register', 'Auth\AuthController@getRegister');
Route::get('/welcome', 'PagesController@welcome');
Route::post('/comment', 'CommentsController@newComment');
Route::post('/contact', 'TicketsController@store');
Route::post('/ticket/{slug?}/edit', 'TicketsController@update');
Route::post('/users/login', 'Auth\AuthController@getLogin');
Route::post('/users/register', 'Auth\AuthController@postRegister');

Route::get('sendemail', function(){
    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message){
        $message->from(env('EMAIL_ADDRESS'), 'Learning Laravel');
        $message->to('kennthompson@gmail.com')->subject('Learning Laravel test email');
    });

    return "Your email has been sent successfully";
});

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'), function(){
    Route::get('users', 'UsersController@index');
});


