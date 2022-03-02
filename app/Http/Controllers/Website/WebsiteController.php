<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('website.dashboard');
    }
    public function hurray()
    {
        return view('website.horay');
    }
    public function paymentCard()
    {
        return view('website.payment-card');
    }
    public function removeCard()
    {
        return view('website.remove-card');
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

}
