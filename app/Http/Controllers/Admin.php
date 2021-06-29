<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Admin extends Controller
{
    
	public function logincheck( Request $request){
		if(Auth::guard('adminuser')->attempt(array('email' => $request->email, 'password' => $request->password)))
		{
		
		return redirect('admin/dashboard');
		}else{
		return redirect('admin/logout');
		}	
	}
	
	
	public function login(){
	
		return view ('admin.login');
	}
	
	
}
