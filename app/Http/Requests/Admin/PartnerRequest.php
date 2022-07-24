<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PartnerRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:100|unique:partners,name,'.$this->id,
            'cpf' => 'required|string|min:10|max:14|unique:partners,cpf,'.$this->id,
            'rg' => 'required|string|min:9|max:12|unique:partners,rg,'.$this->id,
            'email' => 'required|string|min:5|max:100|unique:partners,email,'.$this->id,
            'phone' => 'required|string|min:11|max:20|unique:partners,phone,'.$this->id,
            'nis' => 'nullable|string|min:11|max:14|unique:partners,nis,'.$this->id,
            'spouses_name' => 'nullable|string|min:5|max:100',
            'mothers_name' => 'nullable|string|min:5|max:100',
            'fathers_name' => 'nullable|string|min:5|max:100',
            'isLiterate' => 'required|boolean',
            'scholarity' => 'required|string|min:5|max:100',
            'marital_status' => 'required|string|min:5|max:100',
            'born_city' => 'nullable|string|min:5|max:100',
            'born_date' => 'required|string|min:5|max:100',
            'isCurrentUser' => 'required|boolean',
            'isPresidentUser' => 'required|boolean',
            'postal_code' => 'required|string|min:8|max:10',
            'state_id' => 'required|string',
            'city_id' => 'required|string',
            'user_id' => 'nullable|string',
            'organization_id' => 'required',
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
