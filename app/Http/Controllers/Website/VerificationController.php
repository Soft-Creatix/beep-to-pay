<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VerificationController extends Controller
{
    public function verifyOTP()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $phoneVerificationCode = rand(1000,9999);
        $user->phone_otp = $phoneVerificationCode;
        $user->save();

        $messageText = "Your verification code for BeepToPay is: " . $phoneVerificationCode;
        $smsApiKey = env('SMS_API_KEY' , 'C20028525e987cee08a299.44558809');
        $phone_number = '+923335806128';

        Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone_number&senderid=MyRide&msg=$messageText");

        return view('website.auth.verify');
    }
}
