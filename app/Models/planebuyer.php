<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaneBuyer extends Model
{
    protected $table = 'plane_buyers';

    protected $fillable = [
        'user_id',
        'plane_id',
        'screenshot',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plane()
    {
        return $this->belongsTo(Plane::class, 'plane_id');
    }
}