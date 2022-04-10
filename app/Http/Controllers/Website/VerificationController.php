<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\SMSController;
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

            $phone_number = $user->phone_number;
            $messageText = "Your verification code is: " . $phoneVerificationCode;

            $smsController = new SMSController();
            $smsController->sendSMS($phone_number, $messageText);
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
            return redirect(route('website.payment-pin'))->with(['success' => 'Your phone number has been verfied successfully!']);
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

        $phone_number = $user->phone_number;
        $messageText = "Your verification code is: " . $phoneVerificationCode;

        $smsController = new SMSController();
        $smsController->sendSMS($phone_number, $messageText);

        return 'true';
    }

}
