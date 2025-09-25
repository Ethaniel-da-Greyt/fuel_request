<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
    
class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $user = Users::where("email", $data["email"])->first();

            if ($user) {
                return response()->json(
                    [
                        'status' => 400,
                        'error' => 'Email already taken'
                    ]
                );
            }
            $user->create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);

            return response()->json(['status' => 200, 'message' => 'User Created Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = new Users();
            $data = $request->validated();

            if (!$data) {
                return response()->json(['status' => 400, 'error' => 'Error at filling data']);
            }

            $user->update($id, $data);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = Users::find($id);

            if (!$user) {
                return response()->json(['status' => 400, 'error' => 'User not Found']);
            }

            $user->update(['isDelete' => 1]);
            return response()->json(['status' => 200, 'message' => 'User Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function fetchUser($id)
    {
        try {
            $user = Users::find(intval($id));
            if (!$user) {
                return response()->json(['status' => 400, 'error' => 'User not found']);
            }

            return response()->json(['status' => 200, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function fetchAllUser()
    {
        try {
            $user = Users::all();

            if (count($user) < 0) {
                return response()->json(['status' => 400, 'error' => 'No Users found']);
            }

            return response()->json(['status' => 200, 'data' => $user]);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }
}
