<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
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
            return $this->createRules();

    }
    public function createRules()
    {
        return [
            'name' => 'required|min:4',
            'details' => 'required|min:6',
            'photos' => 'nullable|array',
            'price'=>'required|integer',
            'quantity'=>'required|integer',
            'image.*' => 'image|mimes:jpg,jpeg',
            'categories_id'=>'array|required',
            'categories_id.*'=>'exists:categories,id'
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
