<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function cards() {

        $cards = Card::where('user_id', auth()->user()->id)->get(['card_number', 'month', 'year', 'cardholder_name',]);
        $responseArray['cards'] = $cards;

        return response()->json([
            'data' => $responseArray,
            'code' => 200,
            'message' => 'Cards fetched successfully!',
        ], 200);
    }

    public function verifyCardPin(Request $request) {

        $request->validate([
            'card_pin' => 'required|string|max:4'
        ]);

        $user = auth()->user();

        if($user->card_pin == "0") {
            return response()->json([
                'data' => [],
                'code' => 400,
                'message' => 'The card pin is not being setup',
            ]);
        }

        if(base64_decode($user->card_pin) == $request->card_pin) {
            return response()->json([
                'data' => [],
                'code' => 200,
                'message' => 'Card pin verified successfully!',
            ], 200);
        } else {
            return response()->json([
                'data' => [],
                'code' => 400,
                'message' => 'Card pin verification failed',
            ], 400);
        }
    }
}
