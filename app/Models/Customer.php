<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes; // databaseden kalıcı olarak kullanıcı veya herhangi bişiyi silmez.

    protected $primaryKey = 'customer_id';
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'surname',
        'phone'
    ];

    public function jobs()
    {
        return $this->hasMany(Customer::class, 'customer_id', 'customer_id');
    }
}
