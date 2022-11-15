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
            'user_id' => 'required',
            'vehicle_type_id' => 'required',
            'status' => 'required',
            'plate_number' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|date:start_date'
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'Service id is Required!',
            'customer_id.required' => 'Customer id is Required!',
            'user_id.required' => 'User id is Required!',
            'vehicle_type_id.required' => 'Vehicle Type id is Required!',
            'status.required' => 'Status is Required!',
            'plate_number.required' => 'Plate Number is Required!',
            'start_date.required' => 'Start Date is Required!',
            'end_date.required' => 'End Date is Required!'
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
