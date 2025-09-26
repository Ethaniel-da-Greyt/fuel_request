<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'requestor_name' => "required",
            'requestor_office' => "required",
            'requestor_head_office' => "required",
            'plate_no' => "required",
            'vehicle' => "required",
            'fuel_type' => "required",
        ];
    }
}
