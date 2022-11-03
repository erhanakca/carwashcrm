<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'service_id';
    protected $table = 'services';

    protected $fillable = [
        'name',
        'price',
        'cost'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'service_id', 'service_id');
    }
}
