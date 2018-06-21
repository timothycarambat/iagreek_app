<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Session;
use Storage;

use App\Campaign;
use App\SignRequest;

class ArchiveController extends Controller
{
    public static function deleteArchive($campaign_id){
      $campaign = Campaign::where('id', (integer)$campaign_id)->get()[0];
      $campaign->sign_requests()->delete();
      Storage::deleteDirectory("campaigns/".$campaign->dir);
      $campaign->delete();
      Session::flash('success','The Campaign has been permenantly deleted!');
      Redirect::to('/archives')->send();
    }
}
