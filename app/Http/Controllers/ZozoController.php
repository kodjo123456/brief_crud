<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZozoController extends Controller
  
    {
        public function logout(){
    
            Auth::logout();
            return redirect('/');
        }
    
       
    
        public function login(){
    
            return view('users/login');
        }
    
        public function vue(){
            if(Auth::check())
    
            return view('login');
        }
    }
    
    

