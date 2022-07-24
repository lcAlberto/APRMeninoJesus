<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'cnpj', 'name', 'postal_code', 'state_id', 'city_id'
    ];

    protected $dates = ['deleted_at'];

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function city()
    {
        return $this->hasOne(City::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    public function patrimony()
    {
        return $this->hasMany(Partner::class);
    }
}
