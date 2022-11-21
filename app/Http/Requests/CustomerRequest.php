<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class CustomerRequest extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is Required!',
            'surname.required' => 'Surname is Required!',
            'phone.required' => 'Phone is Required!'
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' =>$validator->errors()->first(),
            'data' => null
        ], 422));
    }


}
