<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'is_light_theme',
        'orgaization_id',
        'user_id'
    ];
}
