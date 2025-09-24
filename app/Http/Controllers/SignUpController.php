<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request)
    {
        try {
            $data = $request->validated();
            $user = Users::where('email', $data['email'])->first();

            if ($user) {
                return response()->json(
                    [
                        "status" => 400,
                        'error' => 'Email Already Used',
                        'message' => 'Email Already Used'
                    ]
                );
            }

            $password = Hash::make($data['password']);
            Users::create([
                'email' => $data['email'],
                'password' => $password,
                'name' => $data['name'],
            ]);

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'SignUp Successfully'
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "status" => 400,
                    "message" => $e->getMessage()
                ]
            );
        }
    }
}
