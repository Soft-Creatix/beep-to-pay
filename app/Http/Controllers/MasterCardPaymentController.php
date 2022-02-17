<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mastercard\Developer\OAuth\Utils\AuthenticationUtils;
use Mastercard\Developer\OAuth\OAuth;

class MasterCardPaymentController extends Controller
{

    public function index()
    {

        // finger print value
        // 243E6992EA467F1CBB9973FACFCC3BF17B5CD007
        $keypath = 'https://beeptopay.codigosol.co.uk/BeepToPay-sandbox-new.p12';
        // return response()->json(['path' => $keypath]);
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'BeepToPay',
            'Godisgeat@134'
        );

        // …
        $consumerKey = 'WjxVxZ1B0U0ZdINeYSVVJqqIiwo9o4f2GTEXcma3da5c2ec1!87a0dfd5099146ce8a5dd9dc3cbab55d0000000000000000';
        $uri = 'https://sandbox.api.mastercard.com/service';
        $method = 'POST';
        $payload = 'Hello world!';
        $authHeader = OAuth::getAuthorizationHeader($uri, $method, $payload, $consumerKey, $signingKey);

        return response()->json(['data' => $authHeader]);
    }
}
