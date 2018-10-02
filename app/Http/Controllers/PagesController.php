<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

use App\Document;
use App\Member;
use App\Campaign;

class PagesController extends Controller
{

    public function doLogin() {
      // validate the info, create rules for the inputs
      $rules = array(
          'email'    => 'required|email|exists:users,email', // make sure the email is an actual email
          'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
      );
      $messages = [
        'required' => 'The :attribute field is required.',
        'email' => 'The email input is not a valid email adddress.',
        'exists' => 'That email was not found as a user.'

     ];

      $validator = Validator::make(Input::all(), $rules, $messages);

      if ($validator->fails()) {
          return Redirect::to('/')
              ->withErrors($validator) // send back all errors to the login form
              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {
          // create our user data for the authentication
          $userdata = array(
              'email'     => Input::get('email'),
              'password'  => Input::get('password')
          );

          // attempt to do the login
          if (Auth::attempt($userdata)) {
              return Redirect::to('/dashboard');
          } else {
              Session::flash('failure', "That Password was incorrect");
              return Redirect::to('/')
              ->withErrors($validator);
          }

      }
    }

    public function home(){
      return view('app.login',
      [
        'title'=>'Greek Document Managment',
        'view'=>'login'
      ]);
    }

    public function dashboard(){
      return view('app.dashboard',
      [
        'title'=>'Dashboard',
        'view'=>'dashboard'
      ]);
    }

    public function profile(){
      return view('app.profile',
      [
        'title'=>'Profile',
        'view'=>'profile'
      ]);
    }

    public function members(Request $request){
      if($request->showAll){
        $members = Auth::user()->members()->orderBy('status','ASC')->orderBy('name','ASC')->get();
      }else {
        $members = Auth::user()->members()->orderBy('status','ASC')->orderBy('name','ASC')->paginate(15);
      }

      return view('app.members',
      [
        'title'=>'Organization Members',
        'view'=>'members',
        'members' => $members,
        'org_size' => Auth::user()->org_size(),
      ]);
    }

    public function documents(Request $request){
      return view('app.documents',
      [
        'title'=>'Organization Documents',
        'view'=>'documents',
        'documents'=>Auth::user()->documents()->orderBy('updated_at','ASC')->get(),
      ]);
    }

    public function document_edit(Request $request, $doc_id){
      $document = Document::where('id', $doc_id)->get()[0];
      return view('app.document_edit',
      [
        'title'=> $document->name." :: Edit",
        'view'=>'document_edit',
        'document'=> $document,
      ]);
    }

    public function campaigns(Request $request){
      return view('app.campaigns',
      [
        'title'=>'Organization Campaigns',
        'view'=>'campaigns',
        'campaigns'=>Auth::user()->campaigns()->where('archived',false)->orderBy('updated_at','ASC')->get(),
        'total_campaigns' =>Auth::user()->campaigns->count(),
      ]);
    }

    public function campaign_edit(Request $request, $campaign_id){
      $campaign = Campaign::where('id', (integer)$campaign_id)->get()[0];
      return view('app.campaign_edit',
      [
        'title'=>$campaign->name." :: Overview",
        'view'=>'campaign_edit',
        'campaign'=>$campaign,
        'sign_requests' => $campaign->sign_requests()->orderBy('status','DESC')->paginate(10),
      ]);
    }

    public function archives(Request $request){
      return view('app.archives',
      [
        'title'=>'Organization Archive',
        'view'=>'archives',
        'campaigns'=>Auth::user()->campaigns()->where('archived',true)->orderBy('updated_at','ASC')->get(),
      ]);
    }

    public function archive_edit(Request $request, $campaign_id){
      $campaign = Campaign::where('id', (integer)$campaign_id)->get()[0];
      return view('app.archive_edit',
      [
        'title'=>$campaign->name." :: Archived :: Review",
        'view'=>'archive_edit',
        'campaign'=>$campaign,
        'sign_requests' => $campaign->sign_requests()->orderBy('status','DESC')->paginate(10),
      ]);
    }

}
