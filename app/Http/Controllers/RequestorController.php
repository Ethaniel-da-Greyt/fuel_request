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
        $request = RequestModel::where("requestor_id", $user->id)->where('is_deleted', 0)->first();
    }
}
