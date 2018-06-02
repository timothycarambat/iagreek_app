<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;

use Session;
use Redirect;

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
}
