<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O campo :attribute precisa ser aceito.',
    'active_url' => 'O campo :attribute não tem uma URL válida.',
    'after' => 'o campo :attribute precisa ser uma data posterior a :date.',
    'after_or_equal' => 'o campo :attribute precisa ser uma data posterior ou igual a :date.',
    'alpha' => 'O campo :attribute só pode conter letras.',
    'alpha_dash' => 'O campo :attribute só pode conter letras, numeros e símbolos.',
    'alpha_num' => 'O campo :attribute só pode conter letras e números.',
    'array' => ':attribute precisa ser array, ou seja uma lista de itens.',
    'before' => 'O campo :attribute precisa ser uma data posterior ou igual a :date.',
    'before_or_equal' => 'O campo :attribute precisa ter uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => 'O campo :attribute precisa estar entre :min e :max.',
        'file' => 'O campo :attribute precisa ter de :min a :max kilobytes.',
        'string' => 'O campo :attribute precisa ter de :min a :max caracteres.',
        'array' => 'O campo :attribute precisa ter de :min a :max itens.',
    ],
    'boolean' => 'O campo :attribute precisa ser um boleano, ou seja, vrdadeiro ou falso.',
    'confirmed' => 'O campo :attribute não bate com a confirmação.',
    'date' => 'O campo :attribute não está em um formato de data válido.',
    'date_equals' => 'O campo :attribute precisa ser iqual a :date.',
    'date_format' => 'O campo :attribute não está no formato :format.',
//    'different' => 'The :attribute and :other must be different.',
//    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'O campo :attribute precisa estar entre :min e :max digitos.',
    'dimensions' => 'O campo :attribute possui dimensões inválidas.',
//    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'O campo :attribute precisa ser um endereço de email válido.',
//    'ends_with' => 'The :attribute must end with one of the following: :values.',
//    'exists' => 'The selected :attribute is invalid.',
    'file' => 'O campo :attribute precisa ser um arquivo válido.',
//    'filled' => 'The :attribute field must have a value.',
//    'gt' => [
//        'numeric' => 'The :attribute must be greater than :value.',
//        'file' => 'The :attribute must be greater than :value kilobytes.',
//        'string' => 'The :attribute must be greater than :value characters.',
//        'array' => 'The :attribute must have more than :value items.',
//    ],
//    'gte' => [
//        'numeric' => 'The :attribute must be greater than or equal :value.',
//        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
//        'string' => 'The :attribute must be greater than or equal :value characters.',
//        'array' => 'The :attribute must have :value items or more.',
//    ],
    'image' => 'O campo :attribute precisa ser uma imagem válida.',
//    'in' => 'The selected :attribute is invalid.',
//    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'O campo :attribute precisa ser um inteiro.',
//    'ip' => 'The :attribute must be a valid IP address.',
//    'ipv4' => 'The :attribute must be a valid IPv4 address.',
//    'ipv6' => 'The :attribute must be a valid IPv6 address.',
//    'json' => 'The :attribute must be a valid JSON string.',
//    'lt' => [
//        'numeric' => 'The :attribute must be less than :value.',
//        'file' => 'The :attribute must be less than :value kilobytes.',
//        'string' => 'The :attribute must be less than :value characters.',
//        'array' => 'The :attribute must have less than :value items.',
//    ],
//    'lte' => [
//        'numeric' => 'The :attribute must be less than or equal :value.',
//        'file' => 'The :attribute must be less than or equal :value kilobytes.',
//        'string' => 'The :attribute must be less than or equal :value characters.',
//        'array' => 'The :attribute must not have more than :value items.',
//    ],
    'max' => [
        'numeric' => 'O campo :attribute não pode ser maioir que :max.',
        'file' => 'O campo :attribute não pode ser maior que :max kilobytes.',
        'string' => 'O campo :attribute não pode ser maior que :max caracteres.',
        'array' => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes' => 'O campo :attribute precisa ser do tipo: :values.',
    'mimetypes' => 'O campo :attribute precisa ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute precisa ser no mínimo :min.',
        'file' => 'O campo :attribute precisa ter no mínimo :min kilobytes.',
        'string' => 'O campo :attribute precisa ter no mínimo :min caracteres.',
        'array' => 'O campo :attribute precisa ter pelo mínimo :min itens.',
    ],
//    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'O campo :attribute está em formato inválido.',
    'numeric' => 'O campo :attribute precisa ser um número.',
    'password' => 'A senha informada é incorreta.',
//    'present' => 'The :attribute field must be present.',
    'regex' => 'O campo :attribute possui formato inválido',
    'required' => 'O campo :attribute é obrigatório',
    'required_if' => 'O campo :attribute é necessário se o campo :other for :value.',
//    'required_unless' => 'The :attribute field is required unless :other is in :values.',
//    'required_with' => 'The :attribute field is required when :values is present.',
//    'required_with_all' => 'The :attribute field is required when :values are present.',
//    'required_without' => 'The :attribute field is required when :values is not present.',
//    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'Os campos :attribute e :other precisam ser idênticos.',
    'size' => [
        'numeric' => 'O campo :attribute precisa ter :size.',
        'file' => 'O campo :attribute precisa ter :size kilobytes.',
        'string' => 'O :attribute precisa ter :size caracteres.',
        'array' => 'O campo :attribute precisa ter :size itens.',
    ],
//    'starts_with' => 'O :attribute must start with one of the following: :values.',
    'string' => 'O campo :attribute precisa ser um texto em formato string.',
    'timezone' => 'O campo :attribute possui formato inválido.',
    'unique' => 'O :attribute já foi cadastrado.',
    'uploaded' => 'O campo :attribute falhou no upload.',
    'url' => 'O campo :attribute não é uma url válida.',
    'uuid' => 'O campo :attribute precisa der um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'cnpj' => [
            'required' => 'CNPJ é obrigatório',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'cnpj' => 'CNPJ',
        'name' => 'nome',
        'postal_code' => 'CEP',
        'state_id' => 'estado',
        'city_id' => 'cidade',
    ],

];
