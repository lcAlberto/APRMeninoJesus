<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'patrimony_id',
        'user_id',
        'orgaization_id'
    ];
}
