<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return $rules = [
            'name' => 'required|max:255',
            'price' => 'required|max:10',
            'description' => 'required|max:500',
            'forme' => 'nullable|max:100',
            'date_fabrication' => 'nullable|max:60',
            'date_peremption' => 'nullable|max:60',
            'categories' => 'required',
        ];
    }
}
