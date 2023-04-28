<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class AuthenticatedSessionController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('admin')->user();
            return redirect()->route('admin.adminhome');
            // if($user->is_admin == 1){
                // dd($user);
                // return redirect()->route('admin.adminhome')->with('success','You are Logged in sucessfully.');
        //     }
        // }
        // else {
        //     return back()->with('error','Whoops! invalid email and password.');
        // }
    }}

    public function adminLogout(Request $request)
    {
        dd('adsa');
        auth()->guard('admin')->logout();
        // Session::flush();
        
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('admin.logout'));
    }
}