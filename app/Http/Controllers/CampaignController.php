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

    public static function removeCampaign($campaign_id){
      $remove_campaign = Campaign::removeCampaign($campaign_id);
      if($remove_campaign){
        Session::flash('success','The Campaign was sucessfully archived');
      }else{
        Session::flash('error','The Campaign could not be archived');
      }
      Redirect::to('/campaigns')->send();
    }

    public static function responseStatus($campaign_id){
      $campaign = Campaign::find((integer)$campaign_id);
      $sign_requests = $campaign->sign_requests;
      $res = [
        'data' => [0,0,0]//completed,additonals required, no signs
      ];

      foreach($sign_requests as $request){
        //if marked completed and requires no addtional signatures then mark and move on
        if($request->completed && !$request->additional_required) {
          $res['data'][0]++;
          continue;
        }
        //if request demands additional signatures

        if($request->additional_required && $request->status){
          //get additionals and decode json. Then pop off last key b/c it is the completed key.
          //This holds id of members who have/need to additionally sign.
          $additonals = (array)json_decode($request->additionals);
          $additonals = array_values($additonals);
          $completed = (array)array_pop($additonals);
          //if completed is an empty array then this this needs additional signatures
          if(empty($completed)){
            $res['data'][1]++;
          }else{
            //filter out members that are null positions. Then sort that array and the completed array
            $additonals = array_filter($additonals);
            sort($additonals);
            sort($completed);
            //if addtionals are not equal to the completed array -> needs additional signatures
            //otherwise it is actually complete!
            if( $additonals != $completed){
              $res['data'][1]++;
            }else{
              $res['data'][0]++;
            }
          }
        }else{ //this just means the main signed has not attempted to sign yet.
          $res['data'][2]++;
        }
      }

      return json_encode($res);
    }

    public static function sendReminders($campaign_id){
      $campaign = Campaign::where('id', (integer)$campaign_id)->get()[0];
      $campaign->sendReminders();
    }

}
