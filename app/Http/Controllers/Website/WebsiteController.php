<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\SMSController;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Ui\Presets\React;
use Symfony\Component\HttpFoundation\Request;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web', 'user.verified', 'user.payment.pin']);
    }

    public function dashboard()
    {
        $cards = Card::where('user_id', auth()->user()->id)->get();
        $transactions = Transaction::where('user_id', auth()->user()->id)->get();
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

    public function removeCard($id)
    {
        $card = Card::where('id', $id)->first();
        return view('website.remove-card', get_defined_vars());
    }

    public function deleteCard($id)
    {
        Card::where('id', $id)->delete();
        return redirect()->route('website.dashboard')->with('success', 'Card deleted successfully!');
    }

    public function receipt($transaction_id)
    {
        $transaction = Transaction::where('id', $transaction_id)->first();
        return view('website.receipt', get_defined_vars());
    }

    public function spinner()
    {
        return view('website.spinner');
    }

    public function addpaymentCard(Request $request)
    {
        $checkCard = Card::where('card_number', $request->card_number)->first();
        if ($checkCard) return 'false';

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $masterCardController = new PaymentController();
        $cardTokenResponse = $masterCardController->tokenize($data['cardholder_name'], str_replace('-', '', $data['card_number']), $data['month'], $data['year'], $data['cvv']);
        // return $cardTokenResponse;
        if($cardTokenResponse->result == 'SUCCESS' && (isset($cardTokenResponse->status) && $cardTokenResponse->status == 'VALID')) {
            $data['token'] = base64_encode($cardTokenResponse->token);
            $masterCardController->authorizePayment($data['token']);
        } else {
            return 'invalid';
        }

        // For sending pin code on sms
        // $user = User::find(auth()->user()->id);
        // $pinCode = $data['pin'];
        // $phone_number = $user->phone_number;
        // $messageText = "Your card auto-generated pin code is: " . $pinCode;
        // $smsController = new SMSController();
        // $smsController->sendSMS($phone_number, $messageText);

        Card::create($data);
        return 'true';
    }
}
