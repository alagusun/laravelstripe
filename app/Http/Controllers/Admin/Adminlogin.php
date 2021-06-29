<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Adminlogin extends Controller
{
  
	
	public function index(){
	
		return view ('admin.home');
	}
	
	
	public function logout(){
		Auth::guard('adminuser')->logout();
		return view ('admin.login');
	}
}
