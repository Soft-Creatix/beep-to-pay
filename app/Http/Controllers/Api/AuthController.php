<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 400,
                'message' => 'The provided credentials are incorrect',
            ], 400);
        }

        $token = $user->createToken('accessToken')->plainTextToken;
        $user->token = $token;

        $responseArray['user'] = $user;

        return response()->json([
            'data' => $responseArray,
            'code' => 200,
            'message' => 'Logged in successfully!',
        ], 200);

    }
}
