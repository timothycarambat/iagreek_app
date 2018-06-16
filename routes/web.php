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
Route::get('/documents', 'PagesController@documents')->middleware(['auth','subscribed']);
Route::get('/documents/edit/{doc_id}', 'PagesController@document_edit')->middleware(['auth','subscribed','ownsDocument']);
Route::get('/campaigns', 'PagesController@campaigns')->middleware(['auth','subscribed']);





Route::post('/profile/upload/letterhead', 'ProfileController@updateLetterhead')->middleware('auth');
Route::post('/profile/upload/avatar', 'ProfileController@updateAvatar')->middleware('auth');
Route::post('/profile/update', 'ProfileController@updateInfo')->middleware('auth');
Route::post('/profile/update/notify', 'ProfileController@updateNotifs')->middleware('auth');

Route::post('/members/upload/roster', 'MemberController@updateRoster')->middleware('auth');
Route::post('/members/submit/newmember', 'MemberController@addNewMember')->middleware('auth');
Route::post('/members/removeMember', 'MemberController@removeMember')->middleware('auth');
Route::post('/members/editMember', 'MemberController@editMember')->middleware('auth');
Route::post('/members/submitTags', 'MemberController@editTags')->middleware('auth');

Route::post('/documents/new_document', 'DocumentsController@newDocument')->middleware('auth');
Route::get('/documents/remove_document/{doc_id}', 'DocumentsController@removeDocument')->middleware('auth');
Route::post('/documents/edit/{doc_id}/save', 'DocumentsController@saveDocument')->middleware(['auth']);

Route::post('/campaigns/new_campaign', 'CampaignController@createCampaign')->middleware('auth');








Route::post('/user/{user_id}/unsubscribe', 'UserController@cancelAccount')->middleware('auth');
