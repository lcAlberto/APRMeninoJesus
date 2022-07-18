<?php

namespace App\Http\Requests\Root;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'cnpj' => ['required', 'string'],
            'name' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'state_id' => ['required', 'string'],
            'city_id' => ['required', 'string'],
        ];
    }
}
