<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;


class UserControllerPassport extends Controller
{
    public function userregister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        $response=[
            'message'=>'created',
            'status'=>'success',
            'data'=>$user,
            'token' => $token
        ];
        return response()->json($response,200);
        
        // $request->validate(
        //     [
        //         'name'=>'required',
        //         'email'=>'required|email',
        //         'password'=>'required',
                
        //     ]);

        // $user=new User();
        // $user->name=$request->name;
        // $user->email=$request->email;
        // $user->password=Hash::make($request->password);
        // $user->save();
      
        // $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        // return response()->json(['token' => $token], 200);
   
    }
    public function userlogin(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
       
       
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $response=[
                'message'=>'created',
                'status'=>'success',
                'data'=>$data,
                'token' => $token
            ];
            return response()->json($response,200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function details(){
        $user=Auth::guard('api')->user();
        return response()->json(['data'=>$user]);
    }
    

}
