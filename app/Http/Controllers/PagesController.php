<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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

}
