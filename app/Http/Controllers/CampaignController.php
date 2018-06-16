<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
use Redirect;

use App\Campaign;

class CampaignController extends Controller
{
    public static function createCampaign(Request $request){

      //check if arrays from form are submitted empty. If they are set them to null so its easier to check
      if( is_null($request->select_by_tags[0]) ){
        $request['select_by_tags'] = null;
      }
      if (is_null($request->select_by_position[0])) {
        $request['select_by_position'] = null;
      }
      if (is_null($request->select_by_member[0])) {
        $request['select_by_member'] = null;
      }

      //This means they didnt select any kind of qualifer for primary signers
      if( is_null($request->select_by_tags) && is_null($request->select_by_position) && is_null($request->select_by_member) ){
        return Redirect::back()
        ->withInput($request->all())
        ->withErrors(['You must either select primary signers by Tags, Position, or Individal Members']);
      }

      $validatedData = Validator::validate($request->all(),[
        'name' => 'required|string',
        'document' => 'required|integer',
        'expiry' => 'required|after:today',
      ]);

      if(is_null($validatedData)){
        // Campaign is good to create
        Campaign::createCampaign($request);
      }

    }
}
