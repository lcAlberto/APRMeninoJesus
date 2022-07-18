<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 27/06/22
 * Time: 22:09
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterApiRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'img_profile' => ['string', 'min:8', 'max:255'],
            'keep_login' => ['boolean']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Preencha seu nome',
            'name.min:3' => 'Nome precisa ter no mínimo 3 caracteres',
            'name.max:255' => 'Nome precisa ter no máximo 255 caracteres',
            'email.required' => 'Preencha um endereço de email válido',
            'email.email' => 'Preencha um endereço de email válido',
            'password.required' => 'Escolha uma senha segura',
            'password.min:8' => 'Escolha uma senha com no mínimo 8 dígitos',
            'password.min:255' => 'Escolha uma senha com no máximo 255 dígitos',
            'img_profile.min:8' => 'Escolha imagem válida',
            'img_profile.min:255' => 'Escolha imagem válida',
        ];
    }
}

