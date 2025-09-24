<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelRequest;
use App\Models\RequestModel;
use Illuminate\Http\Request;

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

    //Admin Dashboard
    public function getAll(Request $request)
    {
        $search = $request->input('search');

        $fuel = RequestModel::query()
            ->where('is_deleted', 0)
            ->where('status', 'pending')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('request_id', 'like', "%{$search}%")
                        ->orWhere('requestor_name', 'like', "%{$search}%")
                        ->orWhere('vehicle', 'like', "%{$search}%");
                });
            })->get();


        if ($fuel->isEmpty()) {
            return response()->json(['status' => 400, 'error' => 'No Fuel Request Found']);
        }

        // $date = date('Y-m-d h:i:s A', strtotime($fuel->date_requested));
        $fuel->transform(function ($item) {
            $item->formatted_date = date('F d, Y - h:i A', strtotime($item->date_requested));
            return $item;
        });

        return response()->json(['status' => 'success', 'data' => $fuel]);
    }

    public function history()
    {
        $fuel = RequestModel::where('is_deleted', 0)->whereIn('status', ['approve', 'reject'])->orderBy('date_requested', 'DESC')->get();

        if (!$fuel) {
            return response()->json(['status' => 400, 'message' => '']);
        }

        $fuel->transform(function ($item) {
            $item->formatted_date = date('F d, Y - h:i A', strtotime($item->date_requested));
            return $item;
        });

        return response()->json(['status' => 200, 'data' => $fuel]);
    }

    public function approve($id)
    {

        $fuel = RequestModel::where('is_deleted', 0)->where('status', 'pending')->where('id', $id)->first();

        if (!$fuel) {
            return response()->json(['status' => 404, 'message' => 'Request Not Found']);
        }


        $fuel->update([
            'status' => "approve"
        ]);
        return response()->json(['status' => 200,  'message' => 'approve successfully']);
    }

    public function reject($id)
    {
        $fuel = RequestModel::where('is_deleted', 0)->where('status', 'pending')->where('id', $id)->first();

        if (!$fuel) {
            return response()->json(['status' => 404, 'message' => 'Request Not Found']);
        }

        $data['status'] = 'reject';

        $fuel->update($data);
        return response()->json(['status' => 200,  'message' => 'Rejected successfully']);
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
