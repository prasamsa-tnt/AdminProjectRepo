<?php

namespace App\Http\Controllers;
use App\Models\VerificationCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function login(){
        return view('auth.otplogin');
    }
    
    public function generate(Request $request){
        $request->validate(
            [
                'mobile_no'=>'required|exists:users,mobile_no'
            ]
        );
        $verificationCode=$this->generateOtp($request->mobile_no);

        $message='your otp is '.$verificationCode->otp;
        return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',$message);


    }
    public function generateOtp($mobile_no){
        $user=User::where('mobile_no',$mobile_no)->first();
        //if user doesnot have existing otp
        $verificationCode=VerificationCode::where('user_id',$user->id)->latest()->first();

        $now=Carbon::now();//takes current time
        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }
//creates new otp
       return VerificationCode::create([
        'user_id'=>$user->id,
        'otp'=>rand(123456,999999),
        'expire_at'=>Carbon::now()->addMinutes(10),


       ]);

    }
    public function verification($user_id)
    {
        return view('auth.otpVerification')->with([
            'user_id' => $user_id
        ]);
    }
    public function loginWithOtp(Request $request)
    {
        #Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);

        #Validation Logic
        $verificationCode   = VerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
// dd( $verificationCode);
        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
        }

        $user = User::whereId($request->user_id)->first();

        if($user){
            // Expire The OTP
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);

            Auth::login($user);
            
            return redirect('/home');
        }

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }
}
