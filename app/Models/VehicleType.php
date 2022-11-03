<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'vehicle_type_id';
    protected $table = 'vehicle_types';

    protected $fillable = [
      'name',
      'price_multiplier'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'vehicle_type_id', 'vehicle_type_id');
    }
}
