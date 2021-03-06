<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationSetting extends Model
{
    protected $fillable = [
        'max_loan_time',
        'is_light_theme',
        'organization_id',
        'user_id'
    ];
}
