<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class UserIsSubscribed
{

    public function handle($request, Closure $next)
    {
      if ($request->user() && ! $request->user()->subscribed('main')) {
        // This user is not a paying customer...
        $support_email = $_ENV['SUPPORT_EMAIL'];
        Session::flash('failure', "This Acccount's subscription has been suspended or cancelled.
         Contact <a style='color: #0c5460;font-weight:600;' href='mailto:$support_email'>Support</a> if this is not correct.");
        return redirect('/');
      }

      return $next($request);
    }
}
