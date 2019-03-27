<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class BackendLoginController extends Controller
{
	public function __contruct()
	{
		$this->middleware('guest:backend', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('backend::auth.backend_login');
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'username' => 'required',
    		'password' => 'required|min:6',
    	]);

    	if(Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)){

    		return redirect()->route('backend.dashboard');
    	}
    	return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors(['error'=>'Incorrect username or password.']);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('backend.login');
    }

    public function username()
    {
        return 'username';
    }
}
