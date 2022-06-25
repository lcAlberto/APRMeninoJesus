<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patrimony extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'purchased_value',
        'current_value',
        'acquisition_date',
        'sale_date',
        'license_plate',
        'chassis_number',
        'brand',
        'model',
        'orgaization_id'
    ];

    protected $searchBy = [
        'name', 'abbr',
    ];

    protected $dates = ['deleted_at'];
}
