<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Card;
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
        $checkCard = Card::where('user_id', auth()->user()->id)->first();
        if ($checkCard) return 'false';
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Card::create($data);
        return 'true';
    }
}
