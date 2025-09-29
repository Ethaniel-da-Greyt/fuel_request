<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'request_id' => "nullable|string|max:50",
            'requestor_name' => "nullable|string|max:100",
            'requestor_office' => "nullable|string|max:100",
            'requestor_head_office' => "nullable|string|max:50",
            'plate_no' => "nullable|string|max:50",
            'vehicle' => "nullable|string|max:50",
            'fuel_type' => "nullable|string|max:50",
        ];
    }
}
