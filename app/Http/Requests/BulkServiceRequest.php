<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BulkServiceRequest extends FormRequest
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
            'services.*.service_id' => 'required|integer',
            'services.*.name' => 'required|string|max:100',
            'services.*.price' => 'required|integer',
            'services.*.cost' => 'required|integer|lt:services.*.price'
        ];
    }

    public function messages()
    {
        return [
            'services.*.name.required' => 'Name is Required!',
            'services.*.price.required' => 'Price is Required!',
            'services.*.price.integer' => 'Price must be a number',
            'services.*.cost.required' => 'Cost is Required!',
            'services.*.cost.integer' => 'Cost must be a number'
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' =>$validator->errors()->all(),
            'data' => null
        ], 422));
    }
}
