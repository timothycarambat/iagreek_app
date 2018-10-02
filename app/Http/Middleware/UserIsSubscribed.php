<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

use App\Subscription;

class UserIsSubscribed
{

    public function handle($request, Closure $next)
    {
      // This means user signed up with no CC and is still on trial.
      if( $request->user()->onValidTrial() ) {
          return $next($request);
      }elseif ( $request->user()->onExpiredTrial() ) {
        Session::flash('failure', "
        <b>Your Trial is Over :( </b><br><br>
         You will be unable to add members, manage campaigns and documents, and everything else that was so great about IAGREEK.
         Dont worry! You can still download your completed documents!
        <br></br>
        You can view your <b><a style='color:#B33C12' href='profile'>Account</a></b> and enter in your credit card info to continue using this service, but this time with more leg room!
        ");
        return $next($request);
      }

      $sub_name = Subscription::getSubName($request->user()->id);
      if ( $request->user() && !$request->user()->subscribed($sub_name) ) {
        // This user is not a paying customer...
        $support_email = $_ENV['SUPPORT_EMAIL'];
        Session::flash('failure', "This Acccount's subscription has been suspended or cancelled.
         Contact <a style='color: #0c5460;font-weight:600;' href='mailto:$support_email'>Support</a> if this is not correct.");
        return redirect('/')->with([]);
      }

      return $next($request);
    }
}
