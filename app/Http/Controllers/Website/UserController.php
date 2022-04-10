<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web', 'user.verified']);
    }

    public function paymentPin()
    {
        return view('website.payment-pin');
    }

    public function setPaymentPin(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $pin = $request->pin;
        $user->card_pin = $pin;
        $user->save();

        return redirect(route('website.dashboard'))->with(['success' => 'Your pin has been setup successfully!']);
    }
}
