<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 401,
                'error' => 'Unauthorized User'
            ]);
        }

        $user->currentAccessToken()->delete();

        return response()->json(
            [
                'status' => 200,
                'message' => 'Logout Successfully'
            ]
        );
    }
}
