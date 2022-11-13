<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Support\Collection;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
       return Customer::all();
    }
}
