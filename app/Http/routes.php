<?php
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
});

Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');

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

Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('audits', 'AuditTrailsController@index');

//Recipes
Route::get('recipes', 'RecipesController@index');
Route::get('recipes/menu', 'RecipesController@menu');
Route::get('recipe/create', 'RecipesController@create');
Route::post('recipe/create', 'RecipesController@store');
Route::get('recipe/{id?}/edit', 'RecipesController@edit');
Route::post('recipe/{id?}/edit', 'RecipesController@update');
Route::get('recipe/{id?}/delete', 'RecipesController@destroy');
Route::get('recipe/{id?}/pdf', 'RecipesController@recipePdf');
Route::get('recipe/{id?}/show', 'RecipesController@show');
Route::get('recipes/excel', 'RecipesController@recipesExcel');
Route::get('recipes/html/{offset}/{limit}', 'RecipesController@recipesHtml');
Route::get('recipes/pdf/{offset}/{limit}', 'RecipesController@recipesPdf');
Route::post('recipes/search/', 'RecipesController@search');
Route::post('recipes/fix/', 'RecipesController@fix');
