<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web']);
    }

    public function verification()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        // $start = Carbon::now();
        // $end = new Carbon($user->otp_datetime);
        // $now = $start->diff($end)->format('%H:%I:%S');

        if($user->phone_otp == null){
            $phoneVerificationCode = rand(1000, 9999);
            $user->phone_otp = $phoneVerificationCode;
            $user->save();

            $messageText = "Your verification code is: " . $phoneVerificationCode;
            $smsApiKey = env('SMS_API_KEY' , 'C20028525e987cee08a299.44558809');
            $phone_number = $user->phone_code . $user->phone_number;

            Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone_number&senderid=MyRide&msg=$messageText");
        }

        return view('website.auth.verify');
    }

    public function verifyOTP(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $otp = $request->otp1.$request->otp2.$request->otp3.$request->otp4;
        if($otp == $user->phone_otp) {
            $user->is_verified = 1;
            $user->save();
            return redirect(route('website.dashboard'))->with(['success' => 'Your phone number has been verfied successfully']);
        } else {
            return redirect(route('website.verification'))->with(['error' => 'You have entered an invalid OTP']);
        }

    }

    public function resendOTP(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $phoneVerificationCode = $user->phone_otp;
        $user->phone_otp = $phoneVerificationCode;
        $user->save();

        $messageText = "Your verification code is: " . $phoneVerificationCode;
        $smsApiKey = env('SMS_API_KEY' , 'C20028525e987cee08a299.44558809');
        $phone_number = $user->phone_code . $user->phone_number;

        Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone_number&senderid=MyRide&msg=$messageText");

        return 'true';
    }

}
