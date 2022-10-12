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
		$id = $this->id ?? '';

        return [
            'name' => "required|string|unique:cakes,name,{$id},id|max:255",
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'nullable|integer',
            'is_available' => 'boolean',
        ];
    }
}
