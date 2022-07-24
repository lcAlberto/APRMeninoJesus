<?php

namespace App\Http\Requests\Root;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class OrganizationRequest extends FormRequest
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
        $rules = [
            'cnpj' => 'required|string|min:14|max:19|unique:organizations,cnpj,'.$this->id,
            'name' => 'required|string|min:5|max:100|unique:organizations,name,'.$this->id,
            'postal_code' => 'required|string|min:8|max:10',
            'state_id' => 'required|string',
            'city_id' => 'required|string',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
            'max' => 'O campo :attribute precisa ter no máximo :max caracteres',
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
