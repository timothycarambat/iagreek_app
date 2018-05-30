<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function members(){
      return view('app.members',
      [
        'title'=>'Organizaiton Members',
        'view'=>'members'
      ]);
    }

}
