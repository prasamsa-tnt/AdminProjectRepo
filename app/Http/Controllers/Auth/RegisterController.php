<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FireBaseController;

use App\Models\User;

use Kreait\Firebase\Messaging\CloudMessage;

use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'password' => Hash::make($data['password']),
        ]);
        // dd($user);

        // return $user;

        $otp=$this->generate($user);
        $messaging = app('firebase.messaging');
        $token='AAAAwA2MX4Y:APA91bGUR3TSPNuW8l4NAdMVbu5ASIcNH5NHMr8YRYXED4VCDYGT7xWmffLx41WRoxhvrRKRuiLJjyZnWkmHWuMJWUromniCJsHqt7obDckzIa3AzEtHDdcjkPaBu-n-k6nxI1qYgFZ9';
        $message = CloudMessage::withTarget('token',$token)
            // ->withNotification(Notification::create('Title', 'Body'))
            ->withData($otp);
        ;
        $message = CloudMessage::fromArray([
            'token' => $token,
            'notification' => [/* Notification data as array */], // optional
            // 'data' => $otp, // optional
        ]);
        $messaging->send($message);   
       
           

        // dd($otp);
        // echo "sent";
// $message='message sent';
// return redirect()->route('otp.verification', ['user_id' => $otp->user_id])->with('success',$message);

    }
   
    public function generate($user){
        // dd($user);

        // $this->users=$users;
        // $request->validate(
        //     [
        //         'mobile_no'=>'required|exists:users,mobile_no'
        //     ]
        // );
        // dd($users);
        $verification= $this->generateOtp($user->mobile_no);
        return $verification;
// dd($verificationCode);
// Firebase::message()->send([
//     'to'=>$user->mobile_no,
//     'text'=>'otp is'. $verificationCode
// // ]);
// $message='message sent';
//         // $message='your otp is '.$verificationCode->otp;
//         return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',$message);


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
}
