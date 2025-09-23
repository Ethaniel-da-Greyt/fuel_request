<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $user = new User();

            if (!$data) {
                return response()->json(['status' => 400, 'error' => 'Unable to input correct data']);
            }

            $user->create($data);

            return response()->json(['status' => 200, 'message' => 'SignUp Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = new User();
            $data = $request->validated();

            if (!$data) {
                return response()->json(['status' => 400, 'error' => 'Error at filling data']);
            }

            $user->update($id, $data);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['status' => 400, 'error' => 'User not Found']);
            }

            $user->update(['isDelete' => 1]);
            return response()->json(['status' => 200, 'message' => 'User Deleted Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function fetchUser($id)
    {
        try {
            $user = User::find(intval($id));
            if (!$user) {
                return response()->json(['status' => 400, 'error' => 'User not found']);
            }

            return response()->json(['status' => 200, 'user' => $user]);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function fetchAllUser()
    {
        try {
            $user = User::all();

            if (count($user) < 0) {
                return response()->json(['status' => 400, 'error' => 'No Users found']);
            }

            return response()->json(['status' => 200, 'data' => $user]);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }
}
