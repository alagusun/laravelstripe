<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Manager extends Controller
{
    
	public function logincheck( Request $request){
		if(Auth::guard('manager')->attempt(array('email' => $request->email, 'password' => $request->password)))
		{
		
		return redirect('manager/dashboard');
		}else{
		return redirect('manager/logout');
		}	
	}
	
	
	public function login(){
	
		return view ('manager.login');
	}
	
	
}
