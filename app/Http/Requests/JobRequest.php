<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'service_id' => 'required',
            'customer_id' => 'required',
            'vehicle_type_id' => 'required',
            'plate_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'Service is Required!',
            'customer_id.required' => 'Customer is Required!',
            'vehicle_type_id.required' => 'Vehicle Type is Required!',
            'plate_number.required' => 'Plate Number is Required!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' =>$validator->errors()->first(),
            'data' => null
        ], 422));
    }
}
