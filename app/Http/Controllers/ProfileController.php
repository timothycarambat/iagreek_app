<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;

use App\User;

class ProfileController extends Controller
{
    public static function updateLetterhead(Request $request){
      $res =[
        'Status' => null,
        'Message' => null,
        'Data' => null
      ];

      $image = $request->letterhead;
      $extension = strtolower($request->letterhead->extension());
      $validExts = ['png','jpg','jpeg'];

      if( $image->isValid() && in_array($extension, $validExts) ){
        # get file and upload to S3 and get that URL back
        $filename = str_random(12).'.'.$extension;
        $uploadS3 = $image->storeAs('letterheads', $filename, $_ENV['FILESYSTEM_DRIVER'],'public');
        $letterheadURL = Storage::url("letterheads/$filename");
        User::where('id', Auth::user()->id)->update(['letterhead' => $letterheadURL]);

        # craft response object
        $res['Status'] = 'Success';
        $res['Message'] = "Your Letterhead has been updated!";
        $res['Data'] = $letterheadURL;
      }else{
        $res['Status'] = 'Failure';
        $res['Message'] = "Your Letterhead could not be updated. Make sure the file is correct";
      }
      return json_encode($res);
    }

    public static function updateAvatar(Request $request){
      $res =[
        'Status' => null,
        'Message' => null,
        'Data' => null
      ];

      $image = $request->avatar;
      $extension = strtolower($request->avatar->extension());
      $validExts = ['png','jpg','jpeg'];

      if( $image->isValid() && in_array($extension, $validExts) ){
        # get file and upload to S3 and get that URL back
        $filename = str_random(12).'.'.$extension;
        $uploadS3 = $image->storeAs('avatars', $filename, $_ENV['FILESYSTEM_DRIVER'],'public');
        $letterheadURL = Storage::url("avatars/$filename");
        User::where('id', Auth::user()->id)->update(['avatar' => $letterheadURL]);

        # craft response object
        $res['Status'] = 'Success';
        $res['Message'] = "Your Avatar has been updated!";
        $res['Data'] = $letterheadURL;
      }else{
        $res['Status'] = 'Failure';
        $res['Message'] = "Your Avatar could not be updated. Make sure the file is correct";
      }
      return json_encode($res);
    }

    public static function updateInfo(Request $request){
      $validatedData = Validator::validate($request->all(),[
        'email' => 'required|email|max:255',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'state' => 'required|string|size:2',
        'zip' => 'required|string|size:5',
      ]);

      if(is_null($validatedData)){
        $update_user = User::where('id', Auth::user()->id)->update([
          'email' => $request->email,
          'name' => $request->first_name." ".$request->last_name,
          'phone' =>  preg_replace('/\D+/', '', $request->phone),
          'address' => $request->address,
          'city' => $request->city,
          'state' => $request->state,
          'zip' => $request->zip,
          'billing_name' => $request->first_name." ".$request->last_name,
          'billing_phone' => preg_replace('/\D+/', '', $request->phone),
          'billing_address' => $request->address,
          'billing_city' => $request->city,
          'billing_state' => $request->state,
          'billing_zip' => $request->zip,
        ]);
      }
      if( $update_user ){
        Session::flash('success','Account details updated!');
      }else{
        Session::flash('failure','Account details were not updated!');
      }
      return Redirect::to('/profile');
    }

    public static function updateNotifs(Request $request){
      $update_user = User::where('id', Auth::user()->id)->update([
        'email_on_campaign_complete' => $request->email_on_campaign_complete === "on" ? 1:0,
      ]);

      if( $update_user ){
        Session::flash('success','Account notifications updated!');
      }else{
        Session::flash('failure','Account notifications were not updated!');
      }
      return Redirect::to('/profile');

    }
}
