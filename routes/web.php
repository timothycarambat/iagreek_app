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
Auth::routes();

//Base View Routes
Route::get('/',['as'=>'login','uses'=>"PagesController@home"]);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/dashboard', 'PagesController@dashboard')->middleware(['auth','subscribed']);
Route::get('/profile', 'PagesController@profile')->middleware(['auth','subscribed']);
Route::get('/members', 'PagesController@members')->middleware(['auth','subscribed']);


Route::post('/profile/upload/letterhead', 'ProfileController@updateLetterhead')->middleware('auth');
Route::post('/profile/upload/avatar', 'ProfileController@updateAvatar')->middleware('auth');
Route::post('/profile/update', 'ProfileController@updateInfo')->middleware('auth');
Route::post('/profile/update/notify', 'ProfileController@updateNotifs')->middleware('auth');

Route::post('/members/upload/roster', 'MemberController@updateRoster')->middleware('auth');
Route::post('/members/submit/newmember', 'MemberController@addNewMember')->middleware('auth');
Route::post('/members/removeMember', 'MemberController@removeMember')->middleware('auth');
Route::post('/members/editMember', 'MemberController@editMember')->middleware('auth');


Route::post('/user/{user_id}/unsubscribe', 'UserController@cancelAccount')->middleware('auth');
