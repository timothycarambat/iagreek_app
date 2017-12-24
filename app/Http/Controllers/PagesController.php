<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
      return view('marketing.home',
      [
        'title'=>'Greek Document Managment',
        'view'=>'home'
      ]);
    }

    public function about(){
      return view('marketing.about',
      [
        'title'=>'About',
        'view'=>'about'
      ]);
    }

    public function login(){
      return view('marketing.login',
      [
        'title'=>'Login',
        'view'=>'login'
      ]);
    }

    public function register(){
      return view('marketing.register',
      [
        'title'=>'Sign Up',
        'view'=>'register'
      ]);
    }
}
