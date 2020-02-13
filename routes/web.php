<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/beitraege', 'ThreadsController@index');
Route::get('/beitraege/create', 'ThreadsController@create');
Route::get('/beitraege/{category}/{thread}', 'ThreadsController@show');
Route::delete('/beitraege/{category}/{thread}', 'ThreadsController@destroy');
Route::post('/beitraege', 'ThreadsController@store');
Route::get('/beitraege/{category}', 'ThreadsController@index');

Route::post('/beitraege/{category}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
Route::delete('/beitraege/{category}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

Route::get('/beitraege/{category}/{thread}/replies', 'RepliesController@index');
Route::post('/beitraege/{category}/{thread}/replies', 'RepliesController@store');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy');

Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');


Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');



Route::get('api/users', 'Api\UsersController@index');

Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth');



