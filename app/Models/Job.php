<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'job_id';
    protected $table = 'jobs';

    protected $fillable = [
        'service_id',
        'customer_id',
        'user_id',
        'status',
        'vehicle_type_id',
        'plate_number',
        'start_date',
        'end_date'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_date',
        'end_date'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function service()
    {
        return $this->hasOne(Service::class, 'service_id', 'service_id')->withTrashed();
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'customer_id', 'customer_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function vehicleType()
    {
        return $this->hasOne(VehicleType::class, 'vehicle_type_id', 'vehicle_type_id');
    }
}

