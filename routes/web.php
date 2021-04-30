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

use App\Mail\NewUserWelcomeMail;

Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::get('search', 'SearchController@search')->name('search');
Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');

Route::get("/chat", function(){
    return view("chat");
 });

Route::post('follow/{user}', 'FollowsController@store');
Route::post('like/{post}', 'LikesController@store');

Route::get('/', 'PostsController@index');
Route::get('/p/create', 'PostsController@create');
Route::get('/p/remove/{post}', 'PostsController@remove');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show')->name('post.show');

Route::post('/c', 'PostsController@commentStore');

Route::get('/contacts', 'ProfilesController@getContacts');
Route::get('/conversation/{contact}', 'ProfilesController@getConversation');
Route::post('/conversation/send', 'ProfilesController@send');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
Route::get('/values', 'HomeController@index')->name('values');


