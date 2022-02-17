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
        $keypath = 'https://beeptopay.codigosol.co.uk/Test-sandbox.p12';
        // return response()->json(['path' => $keypath]);
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );

        // …
        $consumerKey = 'xekfIwW6tz5XvcmPjp3EKD1v5-y2xiTtpeAkCTsgd15cc079!1aa8e0adf9924009be94e6e93709e2070000000000000000';
        $uri = 'https://sandbox.api.mastercard.com/service';
        $method = 'POST';
        $payload = 'Hello world!';
        $authHeader = OAuth::getAuthorizationHeader($uri, $method, $payload, $consumerKey, $signingKey);

        return response()->json(['data' => $authHeader]);
    }
}
