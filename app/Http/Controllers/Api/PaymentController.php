<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function curlRequest($requestString = '', $payload = null, $method = 'GET') {
        $env = env('APP_ENV');

        // Production Keys
        // MID: 7000000048
        // apiKey: 9190c908162d2c2b8185533c11373119

        // Sandbox Keys
        // Test MID: T7000000073
        // Test apiKey: b55ea98011972e84d0501c74eb073d86


        $baseURL = $env == 'production' ? 'https://bibd.gateway.mastercard.com/api/rest/version/63/merchant/7000000048/' : 'https://test-bibd.mtf.gateway.mastercard.com/api/rest/version/63/merchant/T7000000073/';
        $authentication = $env == 'production' ? 'bWVyY2hhbnQuNzAwMDAwMDA0ODo5MTkwYzkwODE2MmQyYzJiODE4NTUzM2MxMTM3MzExOQ==' : 'bWVyY2hhbnQuVDcwMDAwMDAwNzM6YjU1ZWE5ODAxMTk3MmU4NGQwNTAxYzc0ZWIwNzNkODY=';

        $requestUrl = $baseURL . $requestString;

        // cURL request start
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $requestUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '. $authentication,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

    public function tokenize($cardholder_name, $card_number, $card_expiry_month, $card_expiry_year, $card_cvc)
    {
        $payload = '{
            "sourceOfFunds": {
                "provided": {
                    "card": {
                        "expiry": {
                            "month": "'. $card_expiry_month .'",
                            "year": "'. $card_expiry_year.'"
                        },
                        "number": "'. $card_number .'",
                        "nameOnCard": "'. $cardholder_name .'",
                        "securityCode": "'. $card_cvc .'"
                    }
                },
                "type": "CARD"
            },
            "transaction": {
                "currency": "BND"
            },
            "verificationStrategy": "BASIC"
        }';
        // ACQUIRER
        $response = $this->curlRequest('token', $payload, 'POST');

        return $response;
    }

    public function authorizePayment($card_token)
    {
        $order_id = 'ORDER_ID_' .  substr(sha1(rand()), 24);
        $transaction_id = 'TRANSACTION_ID_' .  substr(sha1(rand()), 24);

        $payload = '{
            "apiOperation": "AUTHORIZE",
            "sourceOfFunds": {
                "token": "'. $card_token .'"
            },
            "order": {
                "amount": "1",
                "currency": "BND",
                "reference": "Authorization hold"
            },
            "transaction": {
                "reference": "Authorization hold for card token: '. substr($card_token, 12) . '"
            }
        }';

        $response = $this->curlRequest('order/'. $order_id .'/transaction' . '/' . $transaction_id, $payload, 'PUT');

        return $response;
    }

    public function transaction(Request $request)
    {
        $card_token = $request->card_token;
        $amount = $request->amount;
        $order_id = 'ORDER_ID_' .  substr(sha1(rand()), 24);
        $transaction_id = 'TRANSACTION_ID_' .  substr(sha1(rand()), 24);

        $payload = '{
            "apiOperation": "PAY",
            "sourceOfFunds": {
                "token": "'. $card_token .'"
            },
            "order": {
                "amount": "'. $amount .'",
                "currency": "BND",
                "reference": "BEEP-TO-PAY TRANSACTION"
            },
            "transaction": {
                "reference": "BEEP-TO-PAY TRANSACTION: '. $transaction_id  . '"
            }
        }';

        $response = $this->curlRequest('order/'. $order_id .'/transaction' . '/' . $transaction_id, $payload, 'PUT');

        return $response;
    }

    /*
    public function capturePayment(Request $request)
    {
        $card_token = $request->card_token;
        $order_id = 'ORDER_ID_' .  substr(sha1(rand()), 24);
        $transaction_id = 'TRANSACTION_ID_' .  substr(sha1(rand()), 24);

        $payload = '{
            "apiOperation": "CAPTURE",
            "sourceOfFunds": {
                "token": "'. $card_token .'"
            },
            "transaction": {
                "amount": "1",
                "currency": "BND"
            }
        }';

        $response = $this->curlRequest('order/'. $order_id .'/transaction' . '/' . $transaction_id, $payload, 'PUT');

        return $response;
    }
    */
}
