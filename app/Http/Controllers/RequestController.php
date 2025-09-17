<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelRequest;
use App\Models\RequestModel;

class RequestController extends Controller
{
    public function add(FuelRequest $request)
    {
        $data = $request->validated();
        if (!$data) {
            return response()->json(['status' => 400, 'message' => 'Input Error']);
        }

        $data['request_id'] = $this->generateRequestId();
        $data['date_requested'] = date('Y-m-d H:i:s');
        $fuel = RequestModel::create($data);
        if (!$fuel) {
            return response()->json(['status' => 400, 'message' => 'Unable to request']);
        }
        return response()->json(['status' => 'success', 'message' => 'Request Successfully']);
    }

    public function getAll()
    {
        $fuel = RequestModel::where('is_deleted', 0)->whereIn('status', ['approve', 'reject', 'pending'])->get();

        if (!$fuel) {
            return response()->json(['status' => 400, 'message' => 'No Fuel Request Found']);
        }

        return response()->json(['status' => 'success', 'data' => $fuel]);
    }

    public function approve($id)
    {
        $fuel = RequestModel::where('is_deleted', 0)->where('status', 'pending')->where('id', $id)->first();

        if (!$fuel) {
            return response()->json(['status' => 404, 'message' => 'Request Not Found']);
        }

        $data['status'] = 'approve';

        $fuel->update($data);
        return response()->json(['status' => 200,  'message' => 'approve successfully']);
    }

    public function generateRequestId()
    {
        $prefix = 'FR' . date('ym');

        $lastRequest = RequestModel::where('request_id', 'like', $prefix . '%')
            ->orderBy('request_id', 'desc')
            ->first();

        if ($lastRequest) {
            $lastNumber = (int) substr($lastRequest->request_id, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $nextNumberFormatted = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $prefix . '-' . $nextNumberFormatted;
    }
}
