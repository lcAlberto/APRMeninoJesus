<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'duration',
        'isCurrent',
        'orgaization_id'
    ];
}
