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

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
    Route::get('/', 'PagesController@home');

    Route::get('users', 'UsersController@index');
    Route::get('users/{id?}/edit', 'UsersController@edit');
    Route::post('users/{id?}/edit','UsersController@update');

    Route::get('/users/excel', 'UsersController@excel');
    Route::get('/users/screen', 'UsersController@screen2pdf');
    Route::get('/users/pdf', 'UsersController@report2pdf');

    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');

    Route::get('posts', 'PostsController@index');
    Route::get('posts/create', 'PostsController@create');
    Route::post('posts/create', 'PostsController@store');
    Route::get('posts/{id?}/edit', 'PostsController@edit');
    Route::post('posts/{id?}/edit','PostsController@update');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/create', 'CategoriesController@create');
    Route::post('categories/create', 'CategoriesController@store');
});

Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug?}', 'BlogController@show');

Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');
Route::get('/tickets', 'TicketsController@index');
Route::get('/ticket/{slug?}', 'TicketsController@show');
Route::get('/ticket/{slug?}/edit','TicketsController@edit');
Route::post('/ticket/{slug?}/edit','TicketsController@update');
Route::post('/ticket/{slug?}/delete','TicketsController@destroy');

Route::post('/comment', 'CommentsController@newComment');

//Route::get('home', 'HomeController@index');

Route::get('sendemail', function ()
{
    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message)
    {
        $message->from(env('EMAIL_ADDRESS'), 'Learning Laravel');
        $message->to('kennthompson@gmail.com')->subject('Learning Laravel test email');
    });

    return "Your email has been sent successfully";
});

Route::get('/users/login', 'Auth\AuthController@getLogin');
Route::post('/users/login', 'Auth\AuthController@postLogin');
Route::get('/users/logout', 'Auth\AuthController@getLogout');
Route::get('/users/register', 'Auth\AuthController@getRegister');
Route::post('/users/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('audits', 'AuditTrailsController@index');
Route::get('queries', 'PagesController@queries');
Route::get('slowQueries', 'PagesController@slowQueries');

//Accounting
Route::get('glcoas', 'GlcoasController@index');
Route::get('glcoa/init', 'GlcoasController@checkInit');
Route::get('glcoa/create', 'GlcoasController@create');
Route::post('glcoa/create', 'GlcoasController@store');
Route::get('glcoa/{id?}/edit', 'GlcoasController@edit');
Route::post('glcoa/{id?}/edit', 'GlcoasController@update');
Route::get('glcoa/{id?}/show', 'GlcoasController@show');
Route::get('glcoa/{id?}/delete', 'GlcoasController@destroy');
Route::get('glcoa/detail', 'GlcoasController@detail');
Route::get('glcoa/excel', 'GlcoasController@glcoaExcel');
Route::get('glcoa/pdf', 'GlcoasController@glcoaPdf');

Route::get('gltrns', 'GltrnsController@index');
Route::get('gltrn/create', 'GltrnsController@create');
Route::post('gltrn/create', 'GltrnsController@store');
Route::get('gltrn/{id?}/edit', 'GltrnsController@edit');
Route::post('gltrn/{id?}/edit', 'GltrnsController@update');
Route::get('gltrn/{id?}/show', 'GltrnsController@show');
Route::get('gltrn/{id?}/delete', 'GltrnsController@destroy');

// Enable Database Log Query
//DB::connection()->enableQueryLog();