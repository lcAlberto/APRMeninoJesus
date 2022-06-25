<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
//    use HasFactory;

    protected $fillable = [
        'name', 'abbr'
    ];

    protected $searchBy = [
        'name', 'abbr',
    ];

    protected $dates = ['deleted_at'];


    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
