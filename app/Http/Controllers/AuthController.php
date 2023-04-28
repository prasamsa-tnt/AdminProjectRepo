<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',
                
            ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();

        $token=$user->createToken('API token')->plainTextToken;
        return response()->json(
            [
                'status'=>'success',
                'message'=>'registered',
                'data'=>$token,
            ],200
        );
    }

    public function login(Request $request){
        $request->validate(
            [
            'email'=>'required|email',
            'password'=>'required',
            
            ]
        );
        
        $token=auth()->user()->createToken('API token')->plainTextToken;
        return response()->json(
            [
                'status'=>'success',
                'message'=>'registered',
                'data'=>$token,
            ],200
        );
        // $user=User::where('email','=',$request->email)->first();
        // if($user){
        //     if(Hash::check($request->password,$user->password)){
        //         $request->Session()->put('loginId',$user->id);
        //         return redirect('dashboard');
        //     }
        //     else{
        //         return back()->with('fail','password does not match');
        //     }
        // }
        // else{
        //     return back()->with('fail','email not registered ');
        // }
    }

        // public function logout(Request $request){
        //     auth()->user()->token()->delete();
        //     return response()->json()
        // }

}
