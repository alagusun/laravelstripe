<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Employeelogin extends Controller
{
  
	
	public function index(){
	
		return view ('employee.home');
	}
	
	
	public function logout(){
		Auth::guard('employee')->logout();
		return view ('employee.login');
	}
}
