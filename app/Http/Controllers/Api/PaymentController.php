<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                        "number": "'. str_replace('-', '', $card_number) .'",
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

    public function transaction($card_token, $total_amount, $order_id, $transaction_id)
    {
        // $order_id = 'ORDER_ID_' .  substr(sha1(rand()), 24);
        // $transaction_id = 'TRANSACTION_ID_' .  substr(sha1(rand()), 24);

        $payload = '{
            "apiOperation": "PAY",
            "sourceOfFunds": {
                "token": "'. $card_token .'"
            },
            "order": {
                "amount": "'. $total_amount .'",
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

    public function makePayment(Request $request)
    {
        $card_id = $request->card_id;
        $total_amount = $request->total_amount;
        $vendor_name = $request->vendor_name;
        $vendor_image = $request->vendor_image;
        $user_id = Auth::user()->id;
        $order_id = $request->order_id;
        $order_details = $request->order_details;
        $transaction_id = $request->transaction_id;

        $card = Card::where('id', $card_id)->get(['token'])->first();
        $card_token = base64_decode($card->token);

        $transactionResponse = $this->transaction($card_token, $total_amount, $order_id, $transaction_id);

        // return $transactionResponse;

        if($transactionResponse->result == 'SUCCESS') {
            $transactionRecord = Transaction::create([
                'total_amount' => $total_amount,
                'vendor_name' => $vendor_name,
                'vendor_image' => $vendor_image,
                'user_id' => $user_id,
                'card_id' => $card_id,
                'order_id' => $order_id,
                'order_details' => $order_details,
                'transaction_details' => json_encode($transactionResponse),
                'status' => 'Paid'
            ]);

            $transactionRecord->transaction_details = json_decode($transactionRecord->transaction_details);

            return response()->json([
                'data' => $transactionRecord,
                'code' => 200,
                'message' => 'Your transaction is successful',
            ], 400);
        } else {
            return response()->json([
                'data' => [],
                'code' => 400,
                'message' => 'The transaction is declined',
            ], 400);
        }
    }
}
