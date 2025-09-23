<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request)
    {
        try {
            $data = $request->validated();
            $user = new User();
            $check = $user->where("email", $data["email"])->first();
            if ($check) {
                return response()->json(
                    [
                        "status" => 400,
                        'error' => 'Email Already Used',
                        'message' => 'Email Already Used'
                    ]
                );
            }

            $user->password = Hash::make($data['password']);
            $user->email = $data['email'];
            $user->name = $data['name'];
            $user->save();

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
