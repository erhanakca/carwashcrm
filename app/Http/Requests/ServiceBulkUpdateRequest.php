<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceBulkUpdateRequest extends FormRequest
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
        $rules = [
            'service_id' => 'required|integer',
            'name' => 'required',
            'price' => 'required|integer',
            'cost' => 'required|integer|lt:price'
        ];

        dd($this->request->all());

        /*foreach ($this->request->get('data') as $item)
        {
            dd($item);
            foreach ($item as $key => $value)
            {
                dd($value, $key);
                $rules[$key] = 'required';
            }
        }
        return $rules;*/
    }
}
