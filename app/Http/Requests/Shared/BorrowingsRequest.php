<?php

namespace App\Http\Requests\Shared;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BorrowingsRequest extends FormRequest
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
        $today = Carbon::today();
        $rules = [
            'start_date' => 'required|date|before_or_equal:'. $today->format('Y-m-d') . '|before_or_equal:end_date',
            'end_date' => 'required|date|before_or_equal:'. $today->format('Y-m-d') .'|after_or_equal:start_date',
            'description' => 'nullable|string|max:255',
            'patrimony_id' => 'required|string|min:1|max:100'
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
