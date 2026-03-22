<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderRating extends Model
{
    protected $table = 'rider-rating';

    public $timestamps = false;

    protected $fillable = [
        'rider_id',
        'rating',
        'user_ip',
    ];

    public function rider()
    {
        return $this->belongsTo(CustomerInfo::class, 'rider_id', 'uid');
    }
}
