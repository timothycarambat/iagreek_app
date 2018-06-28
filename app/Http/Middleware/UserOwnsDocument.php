<?php

namespace App\Http\Middleware;

use Closure;
use Session;

use App\Document;


class UserOwnsDocument
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(!Document::where('id',$request->doc_id)->exists() || Document::find($request->doc_id)->org_admin->id != (integer)$request->user()->id ){
        $support_email = $_ENV['SUPPORT_EMAIL'];
        Session::flash('error', "You do not have permissions on this document. If you believe this is an error contact
        <a style='color: #0c5460;font-weight:600;' href='mailto:$support_email'>Support</a>");
        return redirect('/documents');
      }else{
        return $next($request);
      }
    }
}
