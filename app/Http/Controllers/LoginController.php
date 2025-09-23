<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();

            if (!$data) {
                return response()->json(
                    [
                        'status' => 400,
                        'error' => 'Bad Request',
                        'message' => 'The server cannot or will not process the request due to an apparent client error'
                    ]
                );
            }

            $user = User::find('email', $data['email']);

            if (!$user) {
                return response()->json(
                    [
                        'status' => 404,
                        'error' => 'User Not Found',
                        'message' => 'Email not Found'
                    ]
                );
            }

            if (!Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'status' => 401,
                    'error' => 'Password Incorrect',
                    'message' => 'Password is Incorrect'
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(
                [
                    'status' => 200,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'message' => 'Login Successfully'
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 400,
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}
