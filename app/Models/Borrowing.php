<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'description',
        'patrimony_id',
        'user_id',
        'organization_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function patrimony()
    {
        return $this->belongsTo(Patrimony::class);
    }
}
