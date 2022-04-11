<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function sendSMS($phone_number, $messageText) {

        $MESSAGEBIRD_ACCESS_KEY = env('MESSAGEBIRD_ACCESS_KEY', 'TBLfg8LlW1ZCw6LZFqCRR1UGn');
        $MESSAGEBIRD_ORIGINATOR = env('MESSAGEBIRD_ORIGINATOR', 'BeepToPay');

        $MessageBird = new \MessageBird\Client($MESSAGEBIRD_ACCESS_KEY);
        $Message = new \MessageBird\Objects\Message();
        $Message->originator = $MESSAGEBIRD_ORIGINATOR;
        $Message->recipients = array($phone_number);
        $Message->body = $messageText;

        $MessageBird->messages->create($Message);
    }
}
