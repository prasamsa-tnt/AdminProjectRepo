<?php

namespace App\Http\Controllers;
use App\Providers\FirebaseServiceProvider;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseController extends Controller
{
     public function send(Request $request){
        $user=User::first();

         $messaging = app('firebase.messaging');
        $token='AAAAwA2MX4Y:APA91bGUR3TSPNuW8l4NAdMVbu5ASIcNH5NHMr8YRYXED4VCDYGT7xWmffLx41WRoxhvrRKRuiLJjyZnWkmHWuMJWUromniCJsHqt7obDckzIa3AzEtHDdcjkPaBu-n-k6nxI1qYgFZ9';
        // $message = CloudMessage::withTarget('token',$token)
        //     // ->withNotification(Notification::create('Title', 'Body'))
        //     // ->withData(['key' => 'value']);
        // ;
        $message = CloudMessage::fromArray([
            'token' => $deviceToken,
            'notification' => [/* Notification data as array */], // optional
            'data' => $otp, // optional
        ]);
        $messaging->send($message);   
       
        
    }
    // public function sendPush(){
    //     $messaging = app('firebase.messaging');
    //     $deviceTokens = Auth::user()->deviceTokens()->pluck('device_token')->toArray();

    //     $message = CloudMessage::new();
    //     $message->withNotification(Notification::create('Title', 'Body'));

    //     $sendReport = $messaging->sendMulticast($message, $deviceTokens);
        
    //     return response()->json([
    //         'Successful' => $sendReport->successes()->count(),
    //         'Failed' => $sendReport->failures()->count()
    //     ]);
    // }
}
