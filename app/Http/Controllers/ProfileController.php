<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
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
}
