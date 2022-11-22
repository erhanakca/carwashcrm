<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|between:2,100',
            'surname' => 'required|string|between:2,100',
            'company' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:20|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is Required!',
            'surname.required' => 'Surname is Required!',
            'company.required' => 'Company is Required!',
            'email.required' => 'Email is Required!',
            'password.required' => 'Password is Required!',
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
