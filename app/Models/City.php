<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
//    use HasFactoty;

    protected $fillable = [
        'id',
        'name'
//        'state_id'
    ];

//    protected $dates = ['deleted_at'];

    public function state()
    {
        return $this->hasOne(State::class);
    }
}
