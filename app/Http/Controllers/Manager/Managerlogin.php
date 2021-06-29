<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Managerlogin extends Controller
{
  
	
	public function index(){
	
		return view ('manager.home');
	}
	
	
	public function logout(){
		Auth::guard('manager')->logout();
		return view ('manager.login');
	}
}
