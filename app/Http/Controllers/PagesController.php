<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Document;
use App\Member;
use App\Campaign;

class PagesController extends Controller
{
    public function home(){
      return view('app.login',
      [
        'title'=>'Greek Document Managment',
        'view'=>'login'
      ]);
    }

    public function dashboard(){
      return view('app.dashboard',
      [
        'title'=>'Dashboard',
        'view'=>'dashboard'
      ]);
    }

    public function profile(){
      return view('app.profile',
      [
        'title'=>'Profile',
        'view'=>'profile'
      ]);
    }

    public function members(Request $request){
      if($request->showAll){
        $members = Auth::user()->members()->orderBy('status','ASC')->orderBy('name','ASC')->get();
      }else {
        $members = Auth::user()->members()->orderBy('status','ASC')->orderBy('name','ASC')->paginate(15);
      }

      return view('app.members',
      [
        'title'=>'Organization Members',
        'view'=>'members',
        'members' => $members,
        'org_size' => Auth::user()->org_size(),
      ]);
    }

    public function documents(Request $request){
      return view('app.documents',
      [
        'title'=>'Organization Documents',
        'view'=>'documents',
        'documents'=>Auth::user()->documents()->orderBy('updated_at','ASC')->get(),
      ]);
    }

    public function document_edit(Request $request, $doc_id){
      $document = Document::where('id', $doc_id)->get()[0];
      return view('app.document_edit',
      [
        'title'=> $document->name." :: Edit",
        'view'=>'document_edit',
        'document'=> $document,
      ]);
    }

    public function campaigns(Request $request){
      return view('app.campaigns',
      [
        'title'=>'Organization Campaigns',
        'view'=>'campaigns',
        'campaigns'=>Auth::user()->campaigns()->where('archived',false)->orderBy('updated_at','ASC')->get(),
      ]);
    }

    public function campaign_edit(Request $request, $campaign_id){
      $campaign = Campaign::where('id', (integer)$campaign_id)->get()[0];
      return view('app.campaign_edit',
      [
        'title'=>$campaign->name." :: Overview",
        'view'=>'campaign_edit',
        'campaign'=>$campaign,
        'sign_requests' => $campaign->sign_requests()->orderBy('status','DESC')->paginate(10),
      ]);
    }

}
