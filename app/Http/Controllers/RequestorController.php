<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestorController extends Controller
{
    public function getRequestByUser()
    {
        $user = Auth::user();
        $request = RequestModel::where("requestor_id", $user->id)->where('is_deleted', 0)->get();

        if (!$request) {
            return response()->json(['status' => 401, 'error' => 'No Record Found.']);
        }

        $request->transform(function ($item) {
            $item->formatted_date = date('F d, Y - h:i A', strtotime($item->date_requested));
            return $item;
        });

        return response()->json(['status' => 200, 'data' => $request]);
    }
}
