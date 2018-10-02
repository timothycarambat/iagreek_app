<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Input;
use Illuminate\Mail\Message;
use Illuminate\Http\Request;
use Validator;

use App\User;

class PasswordResetController extends Controller
{
    public function validateEmail(){
      $rules = array(
          'email'    => 'required|email|exists:users,email', // make sure the email is an actual email
      );
      $messages = [
        'required' => 'The :attribute field is required.',
        'email' => 'The email input is not a valid email adddress.',
        'exists' => 'That email was not found as a user.'
     ];
      return $validator = Validator::make(Input::all(), $rules, $messages);
    }

    public function sendEmail(Request $request){
         $validator = PasswordResetController::validateEmail();
         if($validator->fails()) {
           return redirect()->back()->withInput()->withErrors($validator);
         }

         $response = Password::sendResetLink(['email' => $request->email], function (Message $message) {
             $message->subject($this->getEmailSubject());
         });

         switch ($response) {
             case Password::RESET_LINK_SENT:
                 return redirect()->back()->with('success', trans($response));
             case Password::INVALID_USER:
                 return redirect()->back()->withErrors(['email' => trans($response)]);
         }
    }

    public function validateNewPassword(){
      $rules = array(
          'password'    => 'required|confirmed|min:8',
      );
      return $validator = Validator::make(Input::all(), $rules);
    }

    public function resetPassword(Request $request){
      $validator = PasswordResetController::validateNewPassword();
      if($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
      }

      $hashed_token = \DB::table('password_resets')->where('email', $request->email)->pluck('token')[0];
      $user = User::where('email', $request->email)->get()[0];


      $response = Password::reset([
        'email' => $request->email,
        'token' => $request->token,
        'password' => $request->password,
        'password_confirmation' => $request->password,
      ], function(){return true;});

      switch ($response) {
          case Password::PASSWORD_RESET:
              $user->update(['password' => bcrypt($request->password)]);
              return redirect()->to('/')->with('success', "Your password Was successfully reset!");
          case Password::INVALID_TOKEN:
              return redirect()->back()->withErrors(['email' => trans($response)]);
      }



    }
}
