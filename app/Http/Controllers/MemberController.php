<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
use Redirect;

use App\Member;

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
        $addMember = Member::addNewMember($new_member);
      }

      if( $addMember ){
        Session::flash('success','The Member was added and the signup email was sent!');
      }else{
        Session::flash('failure','The Member could not be added!');
      }
      return Redirect::to('/members');

    }
}
