<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MasterCardPaymentController;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Ui\Presets\React;
use Symfony\Component\HttpFoundation\Request;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web', 'user.verified']);
    }

    public function dashboard()
    {
        $cards = Card::all();
        return view('website.dashboard', get_defined_vars());
    }

    public function success()
    {
        return view('website.success');
    }

    public function paymentCard()
    {
        return view('website.payment-card');
    }

    public function removeCard()
    {
        $card = Card::where('user_id', auth()->user()->id)->first();
        return view('website.remove-card', get_defined_vars());
    }

    public function deleteCard($id)
    {
        Card::where('id', $id)->delete();
        return redirect()->route('website.dashboard')->with('message', 'Card deleted successfully!');
    }

    public function receipt()
    {
        return view('website.receipt');
    }

    public function spinner()
    {
        return view('website.spinner');
    }

    public function confirmInfo()
    {
        return view('website.confirm-info');
    }

    public function addpaymentCard(Request $request)
    {
        $checkCard = Card::where('card_number', $request->card_number)->first();
        if ($checkCard) return 'false';

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $masterCardController = new MasterCardPaymentController();
        $cardTokenResponse = $masterCardController->tokenize(str_replace('-', '', $data['card_number']), $data['month'], $data['year']);

        if($cardTokenResponse->result == 'SUCCESS' && (isset($cardTokenResponse->status) && $cardTokenResponse->status == 'VALID')) {
            $data['token'] = $cardTokenResponse->token;
            $masterCardController->authorizePayment($data['token']);
        } else {
            return 'invalid';
        }

        // $user = User::find(auth()->user()->id);
        // $pinCode = $data['pin'];
        // $messageText = "Your card auto-generated pin code is: " . $pinCode;
        // $smsApiKey = env('SMS_API_KEY' , 'C20028525e987cee08a299.44558809');
        // $phone_number = $user->phone_number;
        // Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone_number&senderid=MyRide&msg=$messageText");

        Card::create($data);
        return 'true';
    }
}
