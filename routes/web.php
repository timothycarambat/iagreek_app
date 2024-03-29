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

//Base View Routes
Route::get('/',['uses'=>"PagesController@home"]);
Route::post('login', 'PagesController@doLogin');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/password/reset', 'PagesController@email')->name('password.request');
Route::post('/password/email', 'PasswordResetController@sendEmail')->name('password.email');

Route::get('/password/reset/{token}', 'PagesController@reset')->name('password.reset');
Route::post('/password/reset', 'PasswordResetController@resetPassword');

Route::get('/dashboard', 'PagesController@dashboard')->middleware(['auth','subscribed']);
Route::get('/profile', 'PagesController@profile')->middleware(['auth','subscribed']);
Route::get('/members', 'PagesController@members')->middleware(['auth','subscribed']);
Route::get('/documents', 'PagesController@documents')->middleware(['auth','subscribed']);
Route::get('/documents/edit/{doc_id}', 'PagesController@document_edit')->middleware(['auth','subscribed','ownsDocument']);
Route::get('/campaigns', 'PagesController@campaigns')->middleware(['auth','subscribed']);
Route::get('/campaign/edit/{campaign_id}', 'PagesController@campaign_edit')->middleware(['auth','subscribed','ownsCampaign']);
Route::get('/archives', 'PagesController@archives')->middleware(['auth','subscribed']);
Route::get('/archive/edit/{campaign_id}', 'PagesController@archive_edit')->middleware(['auth','subscribed','ownsCampaign']);



Route::post('/profile/upload/letterhead', 'ProfileController@updateLetterhead')->middleware('auth');
Route::post('/profile/upload/avatar', 'ProfileController@updateAvatar')->middleware('auth');
Route::post('/profile/update', 'ProfileController@updateInfo')->middleware('auth');
Route::post('/billing/update', 'ProfileController@updateBilling')->middleware('auth');
Route::post('/billing/subscribe', 'ProfileController@newSubscription')->middleware('auth');
Route::post('/profile/update/notify', 'ProfileController@updateNotifs')->middleware('auth');
Route::post('/profile/upgrade', 'ProfileController@upgradeSubscription')->middleware('auth');
Route::get('/profile/downgrade', 'ProfileController@downgradeSubscription')->middleware('auth');


Route::post('/members/upload/roster', 'MemberController@updateRoster')->middleware('auth');
Route::post('/members/submit/newmember', 'MemberController@addNewMember')->middleware('auth');
Route::post('/members/removeMember', 'MemberController@removeMember')->middleware('auth');
Route::post('/members/editMember', 'MemberController@editMember')->middleware('auth');
Route::post('/members/submitTags', 'MemberController@editTags')->middleware('auth');

Route::post('/documents/new_document', 'DocumentsController@newDocument')->middleware('auth');
Route::get('/documents/remove_document/{doc_id}', 'DocumentsController@removeDocument')->middleware('auth');
Route::post('/documents/edit/{doc_id}/save', 'DocumentsController@saveDocument')->middleware('auth');
Route::get('/document/preview/{doc_id}', 'DocumentsController@previewDocument')->middleware('auth');


Route::post('/campaigns/new_campaign', 'CampaignController@createCampaign')->middleware('auth');
Route::get('/campaigns/remove_campaign/{campaign_id}', 'CampaignController@removeCampaign')->middleware('auth');
Route::get('campaign/response_status/{id}', 'CampaignController@responseStatus')->middleware('auth');
Route::get('/campaigns/end_campaign/{campaign_id}', 'CampaignController@removeCampaign')->middleware('auth');
Route::get('/campaigns/send_reminders/{campaign_id}', 'CampaignController@sendReminders')->middleware('auth');

Route::get('/archive/delete_campaign/{campaign_id}', 'ArchiveController@deleteArchive')->middleware('auth');











Route::post('/user/{user_id}/unsubscribe', 'UserController@cancelAccount')->middleware('auth');
