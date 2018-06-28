<?php

namespace App\Http\Middleware;

use Closure;
use App\Campaign;

class UserOwnsCampaign{
    public function handle($request, Closure $next){
      if(!Campaign::where('id',$request->campaign_id)->exists() || Campaign::find($request->campaign_id)->org_admin->id != (integer)$request->user()->id ){
        $support_email = $_ENV['SUPPORT_EMAIL'];
        Session::flash('error', "You do not have permissions on this campaign. If you believe this is an error contact
        <a style='color: #0c5460;font-weight:600;' href='mailto:$support_email'>Support</a>");
        return redirect('/campaigns');
      }else{
        return $next($request);
      }
    }
}
