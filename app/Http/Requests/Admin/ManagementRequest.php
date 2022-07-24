<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ManagementRequest extends FormRequest
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
            'duration' => 'required|string',
            'isCurrent' => 'required|boolean',
            'treasurer_id' => 'required',
            'vice_treasurer_id' => 'required',
            'president_id' => 'required',
            'vice_president_id' => 'required',
            'organization_id' => 'required',
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
