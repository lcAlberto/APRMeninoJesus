<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'phone',
        'email',
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
        'organization_id'
    ];

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function city()
    {
        return $this->hasOne(City::class);
    }
}
