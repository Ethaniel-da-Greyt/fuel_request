<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = "fuel_requests";
    protected $fillable = [
        'request_id',
        'date_requested',
        'requestor_id',
        'requestor_name',
        'requestor_office',
        'requestor_head_office',
        'plate_no',
        'vehicle',
        'fuel_type',
        'status',
        'is_deleted',
    ];
}
