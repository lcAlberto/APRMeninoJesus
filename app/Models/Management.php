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
        'organization_id',
        'vice_treasurer_id',
        'president_id',
        'vice_president_id',
        'treasurer_id',
        'vice_treasurer_id'
    ];

    public function president()
    {
        return $this->belongsTo(User::class);
    }

    public function vicePresident()
    {
        return $this->belongsTo(User::class);
    }

    public function treasurer()
    {
        return $this->belongsTo(User::class);
    }

    public function viceTreasurer()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
