<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Redirect;
use Session;
use Auth;

class UserController extends Controller
{
    public static function cancelAccount(Request $request, $user_id){
      # goto cancel account on Strip
      $cancel_account = User::cancelAccount($user_id);

      # send email to support about Cancellation
      $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
      $beautymail->send('emails.account_cancellation',
       ['comments'=>$request->cancel_comments, 'user'=> User::where('id',$user_id)->get()[0] ],
        function($message) use( $request, $user_id) {
          $message
              ->to($_ENV['SUPPORT_EMAIL'])
              ->subject('Account Cancellation');
      });

      return Redirect::to('logout')->send();
    }
}
