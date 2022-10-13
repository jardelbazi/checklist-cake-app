<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCakeRequest extends FormRequest
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
			'name' => "required|string|min:3|max:255",
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'integer',
            'is_available' => 'boolean',
			'subscribers' => 'array',
        ];
    }
}
