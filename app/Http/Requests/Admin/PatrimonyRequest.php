<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PatrimonyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|string|min:1|max:100|unique:patrimonies,code,'.$this->id,
            'name' => 'required|string|min:1|max:100',
            'description' => 'required|string|min:1|max:255',
            'type' => 'required|string|min:1|max:100',
            'purchased_value' => 'required|string|min:1|max:100',
            'current_value' => 'required|string|min:1|max:100',
            'acquisition_date' => 'required|string|min:1|max:100',
            'sale_date' => 'nullable|string|min:1|max:100',
            'license_plate' => 'nullable|string|min:1|max:100',
            'chassis_number' => 'nullable|string|min:1|max:100',
            'brand' => 'nullable|string|min:1|max:100',
            'model' => 'nullable|string|min:1|max:100'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
            'max' => 'O campo :attribute precisa ter no máximo :max caracteres',
            'boolean' => 'O campo :attribute precisa ter um valor Verdadeiro ou Falso',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Campos inválidos',
            'error_message' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
