<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Employee extends Controller
{
    
	public function logincheck( Request $request){
		if(Auth::guard('employee')->attempt(array('email' => $request->email, 'password' => $request->password)))
		{
		
		return redirect('employee/dashboard');
		}else{
		return redirect('employee/logout');
		}	
	}
	
	
	public function login(){
	
		return view ('employee.login');
	}
	
	
}
