<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
use Redirect;

use App\Member;
use App\Subscription;
use App\Fee;

class MemberController extends Controller
{
    // This method will first process and read the roster that is submitted
    // It will then determine if the user can add these people without breaking their plan
    // if it is, we will ask them to upgrade. This upload should NEVER remove members
    public static function updateRoster(Request $request){
      $roster = Member::processRoster($request->roster);
      $results = Member::updateOrCreateMembers($roster);
      return json_encode($results);
    }

    public static function addNewMember(Request $request){
      $validatedData = Validator::validate($request->all(),[
        'email' => 'required|email|max:255',
        'name' => 'required|string',
        'position' => 'required|string',
        'status' => 'required|string',
      ]);

      if(is_null($validatedData)){
        $new_member = [
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt(str_random(20)),
          'position' => $request->position,
          'status' => $request->status,
          'org_admin_id' => Auth::user()->id,
        ];

        if( MemberController::memberCanBeAdded($request) ){
          $addMember = Member::addNewMember($new_member);
          if( $addMember ){
            Session::flash('success','The Member was added and the signup email was sent!');
          }else{
            Session::flash('error','The Member could not be added!');
          }
        }else{
          Session::flash('error',
          "<strong>You're Growing!</strong> Looks like to add this new active member you're gonna need to set some existing members inactive or
           <a style='color:#351515' href='/profile?upgrade=true'>upgrade your subscription!</a>");
        }
      }

      return Redirect::to('/members');
    }

    public static function removeMember(Request $request){
      $res = [
        'Status' => null,
        'Message' => null,
      ];
      $remove_member = Member::find($request->id)->delete();
      if($remove_member){
        $res['Status'] = 'Success';
        $res['Message'] = "The Member was removed!";
      }else{
        $res['Status'] = 'Failure';
        $res['Message'] = "The Member could not be removed.";
      }

      return json_encode($res);
    }

    public static function editMember(Request $request){
      $validatedData = Validator::validate($request->all(),[
        'name' => 'required|string',
        'position' => 'required|string',
        'status' => 'required|string',
      ]);

      if(is_null($validatedData)){
        $update_member = Member::find($request->id)->update([
          'name' => $request->name,
          'position' => $request->position,
          'status' => $request->status,
        ]);
      }

      if( $update_member ){
        Session::flash('success',"The Member's information was updated!");
      }else{
        Session::flash('error','The Member could not be updated!');
      }

      return Redirect::to('/members');
    }

    public static function editTags(Request $request){
      $member = Member::with('tagged')->find($request->id);
      if( empty( trim($request->memberTags)) ){
        // if tag field empty then empty the tags instead of parsing
        $tags = [];
      }else{
        $tags = explode(',',$request->memberTags);
      }
      $member->retag($tags);
      Session::flash('success',"<b>$member->name</b>'s tags were updated!");

      return Redirect::to('/members');
    }

    public static function memberCanBeAdded($request){
      $current_org_size = Member::where('org_admin_id', Auth::user()->id)->where('status','active')->count();
      if($request->status == 'active'){
        if( Subscription::getSubStripePlan(Auth::user()->id) != Fee::determineNewUserSubType($current_org_size + 1) ){
          return false;
        }
      }
      return true;
    }
}
