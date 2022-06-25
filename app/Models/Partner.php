<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'nis',
        'spouses_name',
        'mothers_name',
        'fathers_name',
        'isLiterate',
        'scholarity',
        'marital_status',
        'born_city',
        'born_date',
        'isCurrentUser',
        'isPresidentUser',
        'postal_code',
        'state_id',
        'city_id',
        'user_id',
        'orgaization_id'
    ];
}
