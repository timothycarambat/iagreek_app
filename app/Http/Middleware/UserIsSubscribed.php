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
      $sub_name = Subscription::getSubName($request->user()->id);
      
      if ($request->user() && !$request->user()->subscribed($sub_name) ) {
        // This user is not a paying customer...
        $support_email = $_ENV['SUPPORT_EMAIL'];
        Session::flash('error', "This Acccount's subscription has been suspended or cancelled.
         Contact <a style='color: #0c5460;font-weight:600;' href='mailto:$support_email'>Support</a> if this is not correct.");
        return redirect('/');
      }

      return $next($request);
    }
}
