<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $table = 'customer-info';

    protected $primaryKey = 'uid';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'uid',
        'email',
        'name',
        'photo_url',
        'mob.no',
        'diff',
        'status',
        'location',
        'veh_name',
        'veh_num',
        'fare',
        'created_at',
    ];

    public function ratings()
    {
        return $this->hasMany(RiderRating::class, 'rider_id', 'uid');
    }

    public function getMobileAttribute()
    {
        return $this->attributes['mob.no'] ?? 0;
    }

    public function setMobileAttribute($value)
    {
        $this->attributes['mob.no'] = $value;
    }
}
