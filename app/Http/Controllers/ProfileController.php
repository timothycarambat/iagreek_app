<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;

use App\User;
use App\Subscription;
use App\SystemVar;

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
        ]);
      }
      if( $update_user ){
        Session::flash('success','Account Profile Information updated!');
      }else{
        Session::flash('error','Account Profile Information were not updated!');
      }
      return Redirect::to('/profile');
    }

    public static function updateBilling(Request $request){
      $validatedData = Validator::validate($request->all(),[
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'billing_address' => 'required|string',
        'billing_city' => 'required|string',
        'billing_state' => 'required|string|size:2',
        'billing_zip' => 'required|string|size:5',
        'stripeToken' => 'required',
      ]);

      if(is_null($validatedData)){
        $update_user = User::where('id', Auth::user()->id)->update([
          'billing_name' => $request->first_name." ".$request->last_name,
          'billing_phone' =>  preg_replace('/\D+/', '', $request->billing_phone),
          'billing_address' => $request->billing_address,
          'billing_city' => $request->billing_city,
          'billing_state' => $request->billing_state,
          'billing_zip' => $request->billing_zip,
        ]);
        Auth::user()->updateCard($request->stripeToken);
      }

      if( $update_user ){
        Session::flash('success','Billing Information updated!');
      }else{
        Session::flash('error','Billing Information were not updated!');
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
        Session::flash('error','Account notifications were not updated!');
      }
      return Redirect::to('/profile');

    }

    public static function newSubscription(Request $request){
      // User is on Trial and can be added to Stripe now
      $user = Auth::user();

      // if no Stripe token, send them back
      if(is_null($request['stripeToken'])){
        Session::flash('failure','A Card is Required');
        return Redirect::to('/profile')->withInput()->send();
      }

      // If they input a coupon, but it was invalid
      $hasCoupon = !empty($request['coupon']);
      $couponValid = !empty($request['coupon']) ? Subscription::isCouponValid($request['coupon']) : false;
      if($hasCoupon && !$couponValid){
        Session::flash('failure','That Coupon is Not Valid.');
        return Redirect::to('/profile')->withInput()->send();
      }

      try{
        # register new user and subscribe them to the appropriate plan w/ trial days and coupon if applicable
        if($hasCoupon){
          $user->newSubscription('subscription', $request['org_type']  )
                ->withCoupon($request['coupon'])
                ->create($request['stripeToken'],[
                        'email' => $user->email
                      ]);
        }else{
          $user->newSubscription('subscription', $request['org_type'] )
                ->create($request['stripeToken'],[
                        'email' => $user->email
                      ]);
        }

        $user->trial_ends_at = null;
        $user->save();
        Session::flash('success','Thank you for signing up with <b>IAGREEK</b>! You are now offically subscribed - if you havent you may want to checkout the
        <b><u><a style="color:#42A084" href="'.$_ENV['ALT_URL'].'/getting_started"> getting started guide</a></u></b>.');
        return Redirect::to('/profile')->send();

      }catch(\Stripe\Error\Card $e) {
        # should the card present errors; capture them and return to frontend
          $body = $e->getJsonBody();
          $err  = $body['error'];
          Session::flash('failure',$err['message']);
          return Redirect::to('/profile')->withInput()->send();
      }

      // $user->newSubscription('main', 'monthly')->create($stripeToken);
    }

    public static function upgradeSubscription(){
      $uid = Auth::user()->id;
      $current_plan = Auth::user()
      ->subscription(Subscription::getSubName($uid));
      $upgraded_plan = Subscription::getUpgradePlan($current_plan->stripe_plan);

      $current_plan->swap($upgraded_plan[0]);
      Session::flash('success',"You Plan was upgraded to the <b>$upgraded_plan[1]</b> Plan!");
      Redirect::to('/profile')->send();
    }

    public static function downgradeSubscription(){
      $uid = Auth::user()->id;
      $current_plan = Auth::user()
      ->subscription( Subscription::getSubName($uid));
      $downgrade_plan = Subscription::getDowngradePlan($current_plan->stripe_plan);

      if( Auth::user()->eligableForDowngrade() ){
        $current_plan->swap($downgrade_plan[0]);
        Session::flash('success',"You Plan was changed to the <b>$downgrade_plan[1]</b> Plan!");
      }else{
        Session::flash('error',"You were not eligable for a subscription downgrade!");
      }

      Redirect::to('/profile')->send();
    }
}
